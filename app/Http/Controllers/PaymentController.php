<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    // attributes
    private $order;

    public function __construct($order)
    {
        $this->order = $order;
        $this->order->order_number = 'ORD' . Str::random(5);
    }

    /**
     * Process cash payment
     */
    public function payCash() {}



    /**
     * Method to process cashless payment
     */
    public function payCashless()
    {
        // order to be paid
        $data = [
            'attributes' => [
                'send_email_receipt' => false,
                'show_description' => true,
                'show_line_items' => true,
                'line_items' => [
                    [
                        'amount' => $this->order->total_amount,
                        'currency' => 'PHP',
                        'description' => 'Payment for order #' . $this->order->order_number,
                        'name' => $this->order->products()->pluck('name')->implode(', '),
                        'quantity' => 1
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
    }


    /**
     * Handles successful payments
     */
    public function success() {}
}
