<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    //
    public function updateOrder(Request $request)
    {
        // Determine the request method
        $method = $request->method();

        // log incoming request
        \Log::info('Received upOrder request', [
            'request_method' => $method,
            'request_data' => $request->all()
        ]);
    }
}
