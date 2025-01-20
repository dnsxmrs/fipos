<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    // Store a new product in the database
    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_name' => 'required|string|max:255',
                'product_description' => 'required|string',
                'product_price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,category_id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {

            Log::error('Validation failed: ', $e->validator->errors()->toArray());
           // throw $e; // or handle the exception as needed
            return redirect()->back()->with('error', $e->getMessage());
        }

        if ($request->hasFile('image')) {
            $path = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        } else {
            $path = null;
        }

        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'product_description' => $request->input('product_description'),
            'product_price' => $request->input('product_price'),
            'category_id' => $request->input('category_id'),
            'isAvailable' => true, // Set default value for isAvailable
            'has_customization' => false, // Set default value for has_customization
            'image' => $path,
        ]);

        // Sync with OOS after product creation
        $this->syncWithOos('POST', $product);

        return redirect()->back()->with('status_add', 'Product added successfully!');
    }

    // Update an existing product in the database
    public function update(Request $request)
    {
        try
        {
            $id = $request->input('editProductId');

            // Validate the request
            $request->validate([
                'editProductId' => 'required|exists:products,id',
                'editProductName' => 'required|string|max:255',
                'editProductDescription' => 'nullable|string|max:500',
                'editProductPrice' => 'required|numeric|min:0',
                'editCategoryId' => 'required|exists:categories,category_id',
                'editImage' => 'nullable|image|mimes:jpg,png|max:2048',
            ]);

            $product = Product::findOrFail($id);

            if ($request->hasFile('editImage')) {
                $path = Cloudinary::upload($request->file('editImage')->getRealPath())->getSecurePath();
            } else {
                $path = $product->image ? $product->image : null;
            }

            // Determine the availability status; defaults to false if not present
            $isAvailable = $request->has('editIsAvailable') ? true : false;

            // Update the product
            $product->update([
                'product_name' => $request->input('editProductName'),
                'product_description' => $request->input('editProductDescription'),
                'product_price' => $request->input('editProductPrice'),
                'category_id' => $request->input('editCategoryId'),
                'isAvailable' => $isAvailable, // Explicitly set availability
                'image' => $path,
            ]);

            // Sync with OOS after product update
            $this->syncWithOos('PUT', $product);

            return redirect()->route('admin.menu.products')->with('status_edit', 'Product updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ', $e->validator->errors()->toArray());
           // throw $e; // or handle the exception as needed
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Delete a product from the database
    public function delete(Request $request)
    {
        try {
            $request->validate([
                'delete_product_id' => 'required|exists:products,id',
                'password' => 'required'
            ]);

            if (Hash::check($request->password, Auth::user()->password)) {
                $product = Product::find($request->delete_product_id);

                if ($product) {


                    $product->delete();
                    // Sync with OOS after category deletion
                    $this->syncWithOos('DELETE', $product);

                    return redirect()->back()->with('status_deleted', 'Product deleted successfully');
                }

                return redirect()->back()->with('error', 'Failed to delete product');
            }

            return redirect()->back()->with('error', "Password dont match.");

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    // public function delete($id)
    // {
    //     // Get the product ID from the request body
    //     $product = Product::findOrFail($id);
    //     // Optionally delete the product image from storage
    //     if ($product->image) {
    //         Storage::disk('public')->delete($product->image);
    //     }
    //     // Delete the product
    //     $product->delete();

    //     // Sync with OOS after product deletion
    //     $this->syncWithOos('DELETE', $product);

    //     // Return a JSON response for AJAX requests
    //     return response()->json(['message' => 'Product deleted successfully!'], 200);
    // }

    // Sync with OOS after product operation (create, update, delete)
    protected function syncWithOos(string $method, $product)
    {
        $url = env('PRODUCT_OOS_URL'); // Change to your OOS API endpoint

        // Prepare the data to send to OOS
        $data = [
            'product_id' => $product->id,
            'name' => $product->product_name,
            'description' => $product->product_description,
            'price' => $product->product_price,
            'isAvailable' => $product->isAvailable,
            'has_customization' => $product->has_customization,
            'image' => $product->image,
            'category_number' => $product->category_id,

            // 'name' => 'required|string|max:255', // Ensure the name is required and not too long
            // 'description' => 'nullable|string|max:1000', // Allow null, limit description length to avoid overly large data
            // 'price' => 'required|numeric|between:0,999999.99', // Ensure the price is numeric and within a reasonable range
            // 'isAvailable' => 'required|boolean', // Ensure availability is explicitly set to true/false
            // 'has_customization' => 'required|boolean', // Ensure customization flag is explicitly set
            // 'image' => 'nullable|image|max:2048', // Validate image file if provided, limit size to 2MB
            // 'category_number' => 'nullable|integer|exists:categories,category_number', // Ensure category exists if provided

        ];

        Log::info('Sending data to OOS:', [
            'method' => $method,
            'url' => $url,
            'data' => $data,
            // 'category_number' => $category->category_id,
            // 'category_name' => $category->category_name,
            // 'type' => $category->type,
            // 'beverage_type' => $category->beverage_type,
            // 'image_url' => $category->image ? asset('storage/' . $category->image) : null,
        ]);

        // Perform the HTTP request to sync with OOS
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('POS_API_KEY'), // Include the Authorization Bearer token
                // 'X-CSRF-TOKEN' => $csrfToken, // Include the CSRF token if necessary
            ])->send($method, $url, [
                'json' => $data, // Send data as JSON
            ]);

            if ($response->failed()) {
                Log::error('Failed to sync with OOS', [
                    'method' => $method,
                    'url' => $url,
                    'status' => $response->status(),
                    'message' => $response->body(),
                ]);
            } else {
                Log::info('Successfully synced with OOS', [
                    'method' => $method,
                    'url' => $url,
                    'status' => $response->status(),
                    'message' => $response->body(),
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Error syncing with OOS', [
                'error' => $e->getMessage(),
                'method' => $method,
                'url' => $url,
            ]);
        }
    }
}
