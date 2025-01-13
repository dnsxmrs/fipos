<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

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
    }
}
