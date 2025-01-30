<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Spatie\Activitylog\Models\Activity;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Total Revenue (Sum of paid order totals)
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');

        // 2. Total Dishes Ordered (Assuming you have an order_items table)
        $totalDishesOrdered = OrderProduct::sum('quantity'); // Sum all quantities across all orders

        // 3. Total Customers (Count distinct users who placed an order)
        $totalCustomers = Order::count();

        try {
            // Make the GET request to the external API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('POS_API_KEY'), // Include Authorization Bearer token
            ])->get(env('GET_DASHBOARD_DETAILS')); // Use your environment variable for the API endpoint

            // Log the raw response for debugging purposes
            // Log::info('API Response', ['response' => $response->body()]);

            // Decode the JSON response
            $data = $response->json();
            Log::info('API Response', ['data' => $data]);

            // Check if the response contains the expected data
           // Check if the response body is empty or null
            if ($response->successful()) {
                // Decode the JSON response
                $data = $response->json();

                // Check if the response contains the expected data
                if (is_array($data) && isset($data['status']) && $data['status'] === 'success') {
                    // Update the values with the response data
                    $totalRevenue += (float) $data['totalRevenue'];  // Add external total revenue to local total revenue
                    $totalDishesOrdered += (int) $data['totalDishesOrdered']; // Add external dish count
                    $totalCustomers += (int) $data['totalCustomers']; // Add external customer count
                } else {
                    Log::warning("Error in API response: " . ($data['message'] ?? 'No message'));
                }
            } else {
                Log::error('API request failed', ['status' => $response->status(), 'body' => $response->body()]);
            }
        } catch (\Exception $e) {
            // Log any errors that occur during the API request
            Log::error("Error fetching data from POS API", ['error' => $e->getMessage()]);
        }

        return view('admin.dashboard.dashboard', compact('totalRevenue', 'totalDishesOrdered', 'totalCustomers'));
    }

    public function getMostOrdered(Request $request)
    {
        Log::info("Fetching most ordered items", ['filter' => $request->filter]);

        // Determine the date range based on the selected filter
        $dateRange = $this->getDateRange($request->filter);

        Log::info("Date range determined", ['start' => $dateRange['start'], 'end' => $dateRange['end']]);

        // Retrieve the most ordered items within the date range
        try {
            $mostOrderedItems = OrderProduct::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
                                            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                                            ->groupBy('product_id')
                                            ->orderByDesc('total_quantity')
                                            ->take(10) // Limit to top 10 items
                                            ->get();

            Log::info("Most ordered items retrieved", ['count' => $mostOrderedItems->count()]);

            if ($mostOrderedItems->isEmpty()) {
                Log::warning("No items found for the specified date range");
            }

            // Transform the data to include product names (join with products table)
            $mostOrderedItems = $mostOrderedItems->map(function ($item) {
                $product = $item->product; // Assuming you have a 'product' relationship

                // Check if the product is found
                if (!$product) {
                    Log::warning("Product not found for product_id: " . $item->product_id);
                }

                return [
                    'name' => $product ? $product->product_name : 'Unknown Product',
                    'quantity' => $item->total_quantity,
                ];
            });

            return response()->json($mostOrderedItems);

        } catch (\Exception $e) {
            Log::error("Error retrieving most ordered items", ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error fetching most ordered items'], 500);
        }
    }

    private function getDateRange($filter)
    {
        Log::info("Determining date range", ['filter' => $filter]);

        switch ($filter) {
            case 'today':
                return [
                    'start' => Carbon::today()->startOfDay(),
                    'end' => Carbon::today()->endOfDay(),
                ];
            case 'week':
                return [
                    'start' => Carbon::now()->startOfWeek(),
                    'end' => Carbon::now()->endOfWeek(),
                ];
            case 'month':
                return [
                    'start' => Carbon::now()->startOfMonth(),
                    'end' => Carbon::now()->endOfMonth(),
                ];
            default:
                return [
                    'start' => Carbon::today()->startOfDay(),
                    'end' => Carbon::today()->endOfDay(),
                ];
        }
    }

    public function getMostOrderTypes(Request $request)
    {
        Log::info("Fetching most order types", ['filter' => $request->filter]);

        // Determine the date range based on the selected filter
        $dateRange = $this->getDateRange($request->filter);

        Log::info("Date range determined", ['start' => $dateRange['start'], 'end' => $dateRange['end']]);

        // Retrieve the count of each order type within the date range
        try {
            $orderTypesCount = Order::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
                                    ->selectRaw('order_type, COUNT(*) as count')
                                    ->groupBy('order_type')
                                    ->get();

            Log::info("Order types count retrieved", ['count' => $orderTypesCount->count()]);

            $online = $this->getOnlineOrders($dateRange['start'], $dateRange['end']);

            // Prepare the data to return
            $orderTypeData = [
                'dine-in' => 0,
                'take-out' => 0,
                'online' => $online,
            ];

            // Map the counts to the respective order types
            foreach ($orderTypesCount as $orderType) {
                $orderTypeData[$orderType->order_type] = $orderType->count;
            }

            return response()->json($orderTypeData);

        } catch (\Exception $e) {
            Log::error("Error retrieving order types", ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error fetching order types'], 500);
        }
    }

    public function getOnlineOrders($start, $end)
    {
        try {
            // Prepare the data to send in the POST request (including start and end dates)
            $requestData = [
                'start' => $start,
                'end' => $end,
            ];

            // Make the GET request to the POS API to fetch orders count
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('POS_API_KEY'), // Include Authorization Bearer token
            ])->post(env('GET_ORDERS_COUNT'), $requestData); // Send the start and end dates in the POST request

            // Check if the response is successful (status code 200)
            if ($response->successful()) {
                $data = $response->json(); // Decode the JSON response

                // Assuming the API returns the count of online orders within the date range
                $onlineOrdersCount = $data['online_orders_count'] ?? 0;

                return $onlineOrdersCount[0]['count'] ?? 0;


            } else {
                // Handle unsuccessful response
                Log::error("Failed to fetch online orders", ['status_code' => $response->status()]);
                return response()->json(['message' => 'Error fetching online orders from POS API'], 500);
            }

        } catch (\Exception $e) {
            // Log any errors that occur during the API request
            Log::error("Error fetching online orders", ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error fetching online orders'], 500);
        }
    }

    public function getSalesData(Request $request)
{
    try {
        // Query sales data and group by month
        $salesData = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total_sales')
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();

        Log::info("Sales data retrieved", ['count' => $salesData->count(), 'data' => $salesData]);

        // Initialize the sales array for all 12 months, with 0 sales initially
        $monthlySales = array_fill(0, 12, 0);

        // Fill in the sales data for the months that have orders
        foreach ($salesData as $data) {
            $monthlySales[$data->month - 1] = $data->total_sales;
        }

        return response()->json([
            'success' => true,
            'data' => $monthlySales
        ]);
    } catch (\Exception $e) {
        Log::error("Error fetching sales data", ['error' => $e->getMessage()]);
        return response()->json(['message' => 'Error fetching sales data'], 500);
    }
}




    public function reports()
    {
        return view('admin.reports.reports');
    }

    public function orders()
    {
        return view('admin.order-tracking');
    }


    public function audit()
    {
        // get the audit trails
        $audit_trails = Activity::orderBy('created_at', 'desc')->paginate(10);

        // get the user name based on the user_id
        foreach ($audit_trails as $audit_trail) {
            if ($audit_trail->causer_id) {
                $user = User::find($audit_trail->causer_id);
                if ($user) {
                    $audit_trail->user_name = $user->first_name . ' ' . $user->last_name;
                } else {
                    $audit_trail->user_name = 'Unknown User';
                }
            } else {
                $audit_trail->user_name = 'System';
            }
        }
        return view('admin.audit-trails', compact('audit_trails'));
    }

    public function exportCsv()
    {
        // Get all audit trails (you may need to filter or paginate as per your requirements)
        $audit_trails = Activity::orderBy('created_at', 'desc')->get();

        // Define the CSV file name
        $filename = 'audit_trails_' . now()->format('Y_m_d_H_i_s') . '.csv';

        // Prepare the CSV content
        $headers = [
            'Log Date',
            'Log Name',
            'Action',
            'Performed By'
        ];

        // Map the data for CSV export and retrieve the user names based on the causer_id
        $data = $audit_trails->map(function ($audit_trail) {
            // Get the user name based on the causer_id
            if ($audit_trail->causer_id) {
                $user = User::find($audit_trail->causer_id);
                $user_name = $user ? $user->first_name . ' ' . $user->last_name : 'Unknown User';
            } else {
                $user_name = 'System';
            }

            return [
                $audit_trail->created_at->format('Y-m-d H:i:s'),
                $this->escapeCsvValue($audit_trail->log_name),
                $this->escapeCsvValue($audit_trail->description),
                $this->escapeCsvValue($user_name),
            ];
        });

        // Add the header to the beginning of the data
        $data->prepend($headers);

        // Create the CSV file content
        $csv = implode("\n", $data->map(function ($row) {
            return implode(',', $row);
        })->toArray());

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Escape CSV values that might contain commas, quotes, or newline characters.
     *
     * @param  string  $value
     * @return string
     */
    private function escapeCsvValue($value)
    {
        // Escape double quotes and wrap the value in quotes if necessary
        $escapedValue = str_replace('"', '""', $value);  // Double up quotes
        if (strpos($escapedValue, ',') !== false || strpos($escapedValue, "\n") !== false || strpos($escapedValue, '"') !== false) {
            $escapedValue = '"' . $escapedValue . '"';
        }
        return $escapedValue;
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
