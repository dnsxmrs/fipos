<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Str;

class PaymentController extends Controller
{

    /**
     * Process the payment
     */


    /**
     * Process cash payment
     */
    public function payCash(Request $request)
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

            // store the order
            $storeOrder = new OrderController();
            $orderCreated = $storeOrder->storeOrder(new Request($orders));

            // check if the order creation is success
            if ($orderCreated) {

                // extract the data from the response
                $extractedOrder = $orderCreated->getData()->data;

                // transform the array to be sent
                $payment = [
                    'order_id' => $extractedOrder->id,
                    'amount' => $extractedOrder->total_price,
                    'description' => 'Payment for ' . $extractedOrder->order_number,
                    'mode_of_payment' => $orders['modeOfPayment'],
                    'status' => 'paid'
                ];

                // store the payment
                $response = $this->storePayment(new Request($payment));
                $createdPayment = $response->getData()->data; // get the data

                // check if the payment creation failed
                if (!$createdPayment) {

                    return response()->json([

                        'message' => 'Payment creation failed'

                    ], 200);
                }

                return response()->json([

                    'success' => true,
                    'redirect' => route('menu.show'),
                    'message' => 'Payment created',
                    'data' => $createdPayment

                ], 200);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }



    /**
     * Method to process cashless payment
     */
    public function payCashless(Request $request)
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

            // store the order
            $storeOrder = new OrderController();
            $orderCreated = $storeOrder->storeOrder(new Request($orders));

            // check if the order creation is success
            if ($orderCreated) {

                // order to be paid
                $data = [
                    'attributes' => [
                        'send_email_receipt' => false,
                        'show_description' => true,
                        'show_line_items' => true,
                        'line_items' => [
                            [
                                // 'amount' => $this->order->total_amount,
                                // 'currency' => 'PHP',
                                // 'description' => 'Payment for order #' . $this->order->order_number,
                                // 'name' => $this->order->products()->pluck('name')->implode(', '),
                                // 'quantity' => 1
                            ]
                        ],
                        'payment_method_types' => [
                            'card',
                            'gcash',
                            'paymaya'
                        ],


                    ]
                ];


                $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
                    ->withHeader('Content-Type: application/json')
                    ->withHeader('accept: application/json')
                    ->withBearer(base64_encode(env('AUTH_PAY ')))
                    ->withData($data)
                    ->asJson()
                    ->post();

                // extract the data from the response
                $extractedOrder = $orderCreated->getData()->data;

                // transform the array to be sent
                $payment = [
                    'order_id' => $extractedOrder->id,
                    'amount' => $extractedOrder->total_price,
                    'description' => 'Payment for ' . $extractedOrder->order_number,
                    'mode_of_payment' => $orders['modeOfPayment'],
                    'status' => 'paid'
                ];

                // store the payment
                $response = $this->storePayment(new Request($payment));
                $createdPayment = $response->getData()->data; // get the data

                // check if the payment creation failed
                if (!$createdPayment) {

                    return response()->json([

                        'message' => 'Payment creation failed'

                    ], 200);
                }

                return response()->json([

                    'success' => true,
                    'redirect' => route('menu.show'),
                    'message' => 'Payment created',
                    'data' => $createdPayment

                ], 200);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    /**
     * Store payment to the database
     */
    public function storePayment(Request $request)
    {
        $payment = $request->validate([
            'order_id' => 'nullable|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|max:255',
            'mode_of_payment' => 'required|in:cash,card,gcash,paymaya',
        ]);

        // create payment record
        $recordedPayment = Payment::create([
            'order_id' => $payment['order_id'],
            'amount' => $payment['amount'],
            'description' => $payment['description'],
            'mode_of_payment' => $payment['mode_of_payment'],
            'status' => 'paid'
        ]);

        return response()->json([

            'success' => true,
            'message' => 'Payment recorded successfully',
            'data' => $recordedPayment

        ], 200);
    }


    /**
     * Handles successful payments
     */
    public function success() {}
}
