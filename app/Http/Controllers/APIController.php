<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,jpeg|max:2048', // Validation
        ]);

        $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();

        return response()->json(['url' => $uploadedFileUrl]);
    }
}
