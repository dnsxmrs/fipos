<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Order;
use App\Models\OrderProduct;
use Exception;
use Illuminate\Support\Facades\Http;


class APIController extends Controller
{
    //
    public function updateOrder(Request $request)
    {
        // Determine the request method
        $method = $request->method();

        // log incoming request
        Log::info('Received upOrder request', [
            'request_method' => $method,
            'request_data' => $request->all()
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,jpeg|max:2048', // Validation
        ]);

        $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();

        return response()->json(['url' => $uploadedFileUrl]);
    }

    public function statusUpdate(Request $request)
    {
        // Log incoming request
        Log::info('Received status update request', [
            'request_method' => $request->method,
            'request_data' => $request->all(),
        ]);

        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'order_id' => 'required|integer|exists:orders,id',
                'order_number' => 'required|string',
                'status' => 'required|string|in:pending,preparing,ready,delivery,completed,cancelled',
            ]);

            Log::info('Validated status update request', [
                'validated_data' => $validatedData,
            ]);

            // Find the order in the database using order_id
            $order = Order::where('order_number', $validatedData['order_number'])->first();

            // Update the order status
            $order->status = $validatedData['status'];
            $order->save();

            // Log the successful update
            Log::info('Order status updated successfully', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'new_status' => $order->status,
            ]);

            // Return a success response
            return response()->json([
                'message' => 'Order status updated successfully',
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'new_status' => $order->status,
            ], 200);
            // return response()->json([
            //     'message' => 'Order status updated successfully',
            //     'order_id' => $validatedData['order_id'],
            //     'order_number' => $validatedData['order_number'],
            //     'new_status' => $validatedData['status'],
            // ], 200);
        } catch (Exception $e) {
            // Log the error
            Log::error('Failed to update order status', [
                'error_message' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);

            // Return an error response
            return response()->json([
                'message' => 'Failed to update order status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function ordersFromWeb(Request $request)
    {
        // Log incoming request
        Log::info('Received status update request', [
            'request_method' => $request->method,
            'request_data' => $request->all(),
        ]);

        try {
            // Validate the incoming request
            $payload = $request->validate([
                'order_id' => 'required|integer',
                'order_status' => 'required|string',
                'order_number' => 'required|string',
                'order_date' => 'required',
                'order_time' => 'required',
                'order_items' => 'required|array',
                'notes' => 'nullable|string',
            ]);

            Log::info('Validated request data', ['payload' => $payload]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('POS_API_KEY'), // Include the Authorization Bearer token
                // 'X-CSRF-TOKEN' => $csrfToken, // Include the CSRF token if necessary
            ])->send('post', env('WEB_TO_KDS'), [
                'json' => $payload, // Send data as JSON
            ]);
            if ($response->failed()) {
                Log::error('Failed to sync with OOS', [
                    'status' => $response->status(),
                    'message' => $response->body(),
                    'headers' => $response->headers(),
                    'request_payload' => $payload, // Log the payload you sent
                    'request_url' => env('KDS_URL'), // Log the target URL
                ]);
            } else {
                Log::info('Successfully synced with OOS', [
                    'status' => $response->status(),
                    'message' => $response->body(),
                    'headers' => $response->headers(),
                ]);
            }

        } catch (Exception $e) {
            // Log the error
            Log::error('Failed to create order', [
                'error_message' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);

            // Return an error response
            return response()->json([
                'message' => 'Failed to create order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function statusUpdateWeb(Request $request)
    {
        // Log incoming request
        Log::info('Received status update request for web order', [
            'request_method' => $request->method,
            'request_data' => $request->all(),
        ]);

        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'order_id' => 'required',
                'order_number' => 'required|string',
                'status' => 'required|string|in:pending,preparing,ready,delivery,completed,cancelled',
            ]);

            Log::info('Validated status update request', [
                'validated_data' => $validatedData,
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('POS_API_KEY'), // Include the Authorization Bearer token
                // 'X-CSRF-TOKEN' => $csrfToken, // Include the CSRF token if necessary
            ])->send('post', env('KDS_TO_WEB'), [
                'json' => $validatedData, // Send data as JSON
            ]);
            if ($response->failed()) {
                Log::error('Failed to sync with OOS', [
                    'status' => $response->status(),
                    'message' => $response->body(),
                    'headers' => $response->headers(),
                    'request_payload' => $validatedData, // Log the payload you sent
                    'request_url' => env('KDS_URL'), // Log the target URL
                ]);
            } else {
                Log::info('Successfully synced with OOS', [
                    'status' => $response->status(),
                    'message' => $response->body(),
                    'headers' => $response->headers(),
                ]);
            }


        } catch (Exception $e) {
            // Log the error
            Log::error('Failed to create order', [
                'error_message' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);

            // Return an error response
            return response()->json([
                'message' => 'Failed to create order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function cancelOrder(Request $request)
    {
        // Log incoming request
        Log::info('Received status update request', [
            'request_method' => $request->method,
            'request_data' => $request->all(),
        ]);
        try {
            // 'id' => $id,
            // 'orderNumber' => $orderNumber,
            // 'status' => $status,
            // Validate the incoming request
            $payload = $request->validate([
                'id' => 'required|integer',
                'orderNumber' => 'required|string',
                'status' => 'required|string',
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('POS_API_KEY'), // Include the Authorization Bearer token
                // 'X-CSRF-TOKEN' => $csrfToken, // Include the CSRF token if necessary
            ])->send('post', env('CANCEL_ORDER_FROM_WEB'), [
                'json' => $payload, // Send data as JSON
            ]);
            if ($response->failed()) {
                Log::error('Failed to sync with OOS', [
                    'status' => $response->status(),
                    'message' => $response->body(),
                    'headers' => $response->headers(),
                    'request_payload' => $payload, // Log the payload you sent
                    'request_url' => env('KDS_URL'), // Log the target URL
                ]);
            } else {
                Log::info('Successfully synced with OOS', [
                    'status' => $response->status(),
                    'message' => $response->body(),
                    'headers' => $response->headers(),
                ]);
            }

        } catch (Exception $e) {
            // Log the error
            Log::error('Failed to create order', [
                'error_message' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);

            // Return an error response
            return response()->json([
                'message' => 'Failed to create order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
