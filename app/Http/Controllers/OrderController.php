<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function storeOrder(Request $request)
    {
        $order = $request->validate([
            'order_type' => 'required|in:dine-in, take out',
            'total_price' => 'required|numeric|min:0',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.total_price' => 'required|numeric|min:0',
        ]);

        // sample data
        $order = [
            'order_type' => 'dine-in',
            'total_price' => 1000,
            'products' => [
                [
                    'product_id' => 1,
                    'quantity' => 2,
                    'total_price' => 200
                ],
                [
                    'product_id' => 2,
                    'quantity' => 1,
                    'total_price' => 800
                ]
            ]
        ];


        // process payment
        $payment = new PaymentController($order);
        $payment->payCashless();
    }
}
