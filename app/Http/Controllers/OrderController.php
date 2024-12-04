<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\error;
use function Pest\Laravel\json;

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
            $orderNumber = 'CAF-' . strtoupper(uniqid());

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
                'data' => $createdOrder

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
            $dineInOrders = Order::where('order_type', 'dine-in')
                ->with('products.product')
                ->get();

            $takeOutOrders = Order::where('order_type', 'take-out')
                ->with('products.product')
                ->get();

            return view('cashier.orders.index', compact('dineInOrders', 'takeOutOrders'));
        } catch (\Throwable $th) {

            // Log the exception
            Log::error('Error fetching orders: ' . $th->getMessage());
            throw $th;
        }
    }


    /**
     * Show online orders
     */
    public function showOnlineOrders()
    {
        return view('cashier.orders.online-orders');
    }
}
