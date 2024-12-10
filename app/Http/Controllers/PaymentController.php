<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{

    /**
     * Validate the request
     */
    public function validateRequest(Request $request)
    {
        try {
            $validatedRequest = $request->validate([
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

            // return the validated request
            return $validatedRequest;
        } catch (ValidationException $e) {
            Log::error('Validation Errors:', $e->errors());
            return response()->json(['errors' => $e->errors()], 422);
        }
    }



    /**
     * Process cash payment
     */
    public function payCash(Request $request)
    {
        try {

            // validate request
            $orders = $this->validateRequest($request);

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
            Log::error('Error occurred:', ['error' => $th->getMessage()]);
        }
    }


    /**
     * Method to process cashless payment
     */
    public function payCashless(Request $request)
    {
        try {
            // Validate and process request data
            $orders = $this->validateRequest($request);

            // get the subtotal, tax and discount if any for inclusion in paymongo request
            $taxAmount = $orders['taxAmount'];
            $discountAmount = $orders['discountAmount'];

            Log::info('Calculated tax amount:', ['taxAmount' => $taxAmount]);
            Log::info('Calculated discount amount:', ['discountAmount' => $discountAmount]);

            // Store the order
            $storeOrder = new OrderController();
            $orderCreated = $storeOrder->storeOrder(new Request($orders));

            if ($orderCreated) {
                // Extract order data
                $extractedOrder = $orderCreated->getData()->data;

                // Load order products and their respective product details
                $orderProducts = OrderProduct::where('order_id', $extractedOrder->id)
                    ->with('product')
                    ->get();

                $items = [];
                foreach ($orderProducts as $orderProduct) {
                    if ($orderProduct->product && $orderProduct->product->product_name) {
                        $items[] = [
                            'name' => $orderProduct->product->product_name,
                            'quantity' => (int)$orderProduct->quantity,
                            'amount' => $orderProduct->product->product_price * 100, // Convert to PHP cents
                            'currency' => 'PHP',
                            'description' => $extractedOrder->order_number,
                        ];
                    }
                }

                // Add taxes as a line item
                $items[] = [
                    'name' => 'Tax (12%)',
                    'quantity' => 1,
                    'amount' => intval($taxAmount * 100), // Convert to PHP cents
                    'currency' => 'PHP',
                    'description' => 'VAT Tax',
                ];

                if ($discountAmount != 0) {
                    Log::info('Adding discount line item:', ['discountAmount' => $discountAmount]);

                    // Add discount as a negative line item
                    $items[] = [
                        'name' => 'Discount (20%)',
                        'quantity' => 1,
                        'amount' => -intval($discountAmount * 100), // Convert to PHP cents
                        'currency' => 'PHP',
                        'description' => 'Applied Discount',
                    ];
                }

                // Log final items payload
                Log::info('Final mapped line items sent to PayMongo:', ['line_items' => $items]);

                if (empty($items)) {
                    Log::error('No valid items to process for payment');
                    return response()->json([
                        'error' => 'No valid items to process for payment'
                    ], 400);
                }

                // Structure payload for PayMongo
                $data = [
                    'data' => [
                        'attributes' => [
                            'send_email_receipt' => false,
                            'show_description' => true,
                            'show_line_items' => true,
                            'line_items' => $items,
                            'payment_method_types' => [
                                'card',
                                'gcash',
                                'paymaya'
                            ],
                            'success_url' => route('pay.success'),
                            'cancel_url' => route('menu.show'),
                            'description' => $extractedOrder->order_number,
                            'metadata' => [
                                'order_id' => base64_encode($extractedOrder->id),
                            ]
                        ],
                    ]
                ];

                Log::info('Payload sent to PayMongo:', ['payload' => $data]);

                // Send POST request to PayMongo's checkout endpoint
                $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
                    ->withHeader('Content-Type: application/json')
                    ->withHeader('Accept: application/json')
                    ->withHeader('Authorization: Basic ' . base64_encode(env('AUTH_PAY')))
                    ->withData($data)
                    ->asJson()
                    ->post();



                // Store session ID in the session
                Session::put('session_id', $response->data->id);

                $checkOutUrl = $response->data->attributes->checkout_url;

                // Return with checkout url for redirection
                return response()->json([
                    'success' => true,
                    'message' => 'Successful payment processing',
                    'redirect' => $checkOutUrl
                ]);
            }

            Log::error('Order could not be created');
            return response()->json(['error' => 'Order creation failed'], 400);
        } catch (\Throwable $th) {
            Log::error('Error processing payment:', ['error' => $th->getMessage()]);

            return response()->json([
                'error' => $th->getMessage()
            ]);
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
    public function success()
    {

        $sessionId = Session::get('session_id');

        $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions/' . $sessionId)
            ->withHeader('Content-Type: application/json')
            ->withHeader('Accept: application/json')
            ->withHeader('Authorization: Basic ' . base64_encode(env('AUTH_PAY')))
            ->asJson()
            ->get();

        // dd($response);

        if ($response->data->attributes->payments[0]->attributes->status === "paid") {

            $orderId = (int)base64_decode($response->data->attributes->metadata->order_id);
            $amount = $response->data->attributes->payments[0]->attributes->amount;
            $description = $response->data->attributes->payments[0]->attributes->description;
            $modeOfPayment = $response->data->attributes->payment_method_used;
            $status = $response->data->attributes->payments[0]->attributes->status;

            // load the details
            $paymentToStore = [
                'order_id' => $orderId,
                'amount' => $amount,
                'description' => 'Payment for ' . $description,
                'mode_of_payment' => $modeOfPayment,
                'status' => $status,
            ];

            $payment = $this->storePayment(new Request($paymentToStore));

            if (!$payment) {

                return response()->json([
                    'message' => 'Unsuccessful to save payment'
                ], 400);

            }

            return redirect()->route('menu.show');
        }

    }
}
