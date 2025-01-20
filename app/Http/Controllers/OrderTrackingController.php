<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Http;
use Illuminate\Http\Request;
use Log;

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
        return view('admin.order-tracking.online-orders');

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

