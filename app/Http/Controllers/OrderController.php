<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Session;
use function Laravel\Prompts\error;
use function Pest\Laravel\json;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Models\InventoryCategory;

class OrderController extends Controller
{

    /**
     * Store order
     */
    public function storeOrder(Request $request)
    {
        try {
            $orders = $request->validate([
                'orderType' => 'required|in:dine-in,take-out',
                'discountType' => 'nullable|in:none,senior citizen,pwd',
                'discountAmount' => 'nullable|numeric|min:0',
                'taxAmount' => 'required|numeric|min:0',
                'payableAmount' => 'required|numeric|min:0',
                'subTotal' => 'required|numeric|min:0',
                'modeOfPayment' => 'required|in:cash,cashless',
                'cashAmount' => 'nullable|numeric|min:0',
                'orderItems' => 'required|array',
                'orderItems.*.name' => 'required|string|exists:products,product_name',
                'orderItems.*.quantity' => 'required|integer|min:1',
                'orderItems.*.price' => 'required|numeric|min:0'
            ]);

            // generate random string for order number

            $orderNumber = '';
            do {
                $orderNumber = 'CAF' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
            } while (Order::where('order_number', $orderNumber)->exists());


            // create the order record
            $createdOrder = Order::create([
                'order_number' => $orderNumber,
                'order_type' => $orders['orderType'],
                'total_price' => $orders['payableAmount'],
                'tax_amount' => $orders['taxAmount'],
                'discount_type' => $orders['discountType'],
                'discount_amount' => $orders['discountAmount'],
                'subtotal' => $orders['subTotal'],
                'user_id' => 1
            ]);


            // add the order products to the order
            foreach ($orders['orderItems'] as $order) {

                // get the product id of the respective name
                $product = Product::where('product_name', $order['name'])->first();

                // create the order product record
                OrderProduct::create([
                    'order_id' => $createdOrder->id,
                    'product_id' => $product->id,
                    'quantity' => $order['quantity'],
                    'total_price' => $order['price']
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order Created',
                'data' => $createdOrder,
            ], 201);
        } catch (ValidationException $e) {
            Log::error('Validation Errors:', $e->errors());
            return response()->json(['errors' => $e->errors()], 422);
        }
    }


    /**
     * Show orders
     */
    public function showOrders()
    {
        try {
            // Get the dine-in and take-out orders along with their associated products
            $orders = Order::with('products.product')->paginate(10);

            Log::info($orders);

            $online_orders = $this->fetchOrders();

            return view('cashier.orders.all-orders', compact('orders', 'online_orders'));
        } catch (\Throwable $th) {

            // Log the exception
            Log::error('Error fetching orders: ' . $th->getMessage());
            throw $th;
        }
    }

    /**
     *  Show dine-in orders
     */
    public function showDineInOrders()
    {

        $dineInOrders = Order::where('order_type', 'dine-in')
            ->with('products.product')
            ->paginate(10);

        return view('cashier.orders.dine-in', compact('dineInOrders'));
    }


    /**
     *  Show take-out orders
     */
    public function showTakeOutOrders()
    {

        $takeOutOrders = Order::where('order_type', 'take-out')
            ->with('products.product')
            ->paginate(10);

        return view('cashier.orders.take-out', compact('takeOutOrders'));
    }


    /**
     * Show online orders
     */
    public function showOnlineOrders()
    {
        try {
            $url = env('GET_ORDERS_PAGINATE');
            $url2 = env('GET_ORDERS');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('POS_API_KEY'), // Include the Authorization Bearer token
                // 'X-CSRF-TOKEN' => $csrfToken, // Include the CSRF token if necessary
            ])->send('GET', $url2);

            // Decode JSON response
            $responseData = json_decode($response->body(), true);

            if (isset($responseData['data'])) {
                // $ordersData = $responseData['data']; // Orders array

                // // Get pagination details
                // $currentPage = request()->get('page', 1);
                // $perPage = $responseData['per_page'] ?? 15;
                // $total = $responseData['total'] ?? count($ordersData);

                // // Convert array to Laravel paginator
                // $ordersPaginated = new LengthAwarePaginator(
                //     collect($ordersData), // Convert array to collection
                //     $total, // Total items
                //     $perPage, // Items per page
                //     $currentPage, // Current page
                //     ['path' => request()->url()] // Pagination links
                // );
                // return view('cashier.orders.online-orders', compact('ordersData'));


                // $ordersData = $responseData['data']; // Store orders array

                // // Log the received data for debugging
                // Log::info('Orders data retrieved successfully', ['count' => count($ordersData)]);


                // Ensure 'data' is available and not empty
                if (isset($responseData['data']) && !empty($responseData['data'])) {
                    // Convert raw array to Laravel Collection
                    $ordersCollection = collect($responseData['data']); // Create collection of all orders

                    // Pagination logic
                    $perPage = 15; // Items per page
                    $currentPage = request()->get('page', 1); // Get current page from query params
                    $currentItems = $ordersCollection->slice(($currentPage - 1) * $perPage, $perPage)->all(); // Slice data for current page

                    // Create LengthAwarePaginator
                    $ordersPaginated = new LengthAwarePaginator(
                        $currentItems, // Items for the current page
                        $ordersCollection->count(), // Total items in all pages
                        $perPage, // Items per page
                        $currentPage, // Current page
                        ['path' => request()->url()] // Pagination links
                    );
                } else {
                    // Handle case where there is no data
                    $ordersPaginated = collect(); // Return empty collection
                }

                // Log ordersPaginated as an array
                Log::info('Orders data:', (array) $ordersPaginated);

                // Log the type of ordersPaginated
                Log::info('Type of ordersPaginated:', ['type' => gettype($ordersPaginated)]);



                // Return to view with ordersPaginated
                return view('cashier.orders.online-orders', compact('ordersPaginated'));

            } else {
                Log::warning('Data key not found in response');
                return response()->json(['error' => 'Data key not found in response'], 500);
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching orders: ' . $th->getMessage());
            dd($th);
            return response()->json(['error' => 'Error fetching orders'], 500);
        }
    }


    public function fetchOrders()
    {
        try {
            $url = env('GET_ORDERS_PAGINATE');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('POS_API_KEY'), // Include the Authorization Bearer token
                // 'X-CSRF-TOKEN' => $csrfToken, // Include the CSRF token if necessary
            ])->send('GET', $url);

            // Decode the JSON response into an array
            $responseData = json_decode($response->body(), true);

            if (isset($responseData['data'])) {
                $ordersData = $responseData['data']; // Access the 'data' key
                Log::info('Orders data:', $ordersData);

                // Return or process the orders as needed
                return response()->json($ordersData);
            } else {
                Log::warning('Data key not found in response');
                return response()->json(['error' => 'Data key not found in response'], 500);
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching orders: ' . $th->getMessage());
            return response()->json(['error' => 'Error fetching orders'], 500);
        }
    }

    public function getOrders()
    {
        $orders = Order::with('products.product')->get();
        return response()->json($orders);
    }

    public function exportOrders()
    {
        // Get all orders with their associated products
        $orders = Order::with('products.product')->get();

        // Define CSV file name
        $csvFileName = 'orders_' . date('Y-m-d') . '.csv';

        // Set the response headers for CSV download
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Expires" => "0",
        ];

        // Create and output the CSV content
        $handle = fopen('php://output', 'w');

        // Add CSV headers
        fputcsv($handle, ['No.', 'Order Number', 'Items Ordered', 'Order Type', 'Total Amount', 'Status']);

        // Add data rows for each order
        foreach ($orders as $index => $order) {
            // Concatenate product names for the order
            $productNames = $order->products
                ->map(function ($orderProduct) {
                    return $orderProduct->product->product_name;
                })
                ->implode(', ');

            fputcsv($handle, [
                $index + 1,  // No.
                $order->order_number,
                $productNames,
                ucfirst($order->order_type),
                'PHP ' . number_format($order->total_price, 2),
                ucfirst($order->status),
            ]);
        }

        return response()->stream(function () use ($handle) {
            // Close the file handle
            fclose($handle);
        }, Response::HTTP_OK, $headers);
    }
}
