<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class OrderTrackingController extends Controller
{
    /**
     *  Show all orders
     */
    public function index()
    {
        $orders = Order::with('products.product')->paginate(10);

        return view('admin.order-tracking.all-orders', compact('orders'));
    }

    /**
     *  Show walk in orders
     */
    public function showWalkInOrders()
    {
        $walkInOrders = Order::with('products.product')->paginate(10);

        return view('admin.order-tracking.walk-in', compact('walkInOrders'));
    }

    /**
     *  Show online orders
     */
    public function showOnlineOrders()
    {
        try {
            $url2 = env('GET_ORDERS');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('POS_API_KEY'), // Include the Authorization Bearer token
                // 'X-CSRF-TOKEN' => $csrfToken, // Include the CSRF token if necessary
            ])->send('GET', $url2);

            // Decode JSON response
            $responseData = json_decode($response->body(), true);

            if (isset($responseData['data'])) {
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
                return view('admin.order-tracking.online-orders', compact('ordersPaginated'));
                // return view('cashier.orders.online-orders', compact('ordersPaginated'));

            } else {
                Log::warning('Data key not found in response');
                return response()->json(['error' => 'Data key not found in response'], 500);
            }
        } catch (\Throwable $th) {
            Log::error('Error fetching orders: ' . $th->getMessage());
            dd($th);
            return response()->json(['error' => 'Error fetching orders'], 500);
        }




        // try {
        //     $response = Http::withHeaders([
        //         'Authorization' => 'Bearer ' . env('WEB_API_KEY'), // Include the Authorization Bearer token
        //         // 'X-CSRF-TOKEN' => $csrfToken, // Include the CSRF token if necessary
        //     ])->get('');

        //     if ($response->successful()) {
        //         $responseData = $response->getData()->data; // Get the response as an array

        //         dd($responseData);

        //         return view('admin.order-tracking.online-orders');
        //         // Process the response data
        //     } else {
        //         // Handle the error
        //         $errorMessage = $response->body(); // Get the raw response body
        //         // Log the error or take appropriate action
        //     }
        // } catch (\Exception $e) {
        //     // Handle exceptions
        //     Log::error('HTTP GET request failed: ' . $e->getMessage());

        //     dd($e->getMessage());
    }






}

