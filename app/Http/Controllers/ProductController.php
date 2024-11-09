<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
            throw $e; // or handle the exception as needed
        }
        // Initialize path as null
        $path = null;
        // Handle the file upload if an image is provided
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/products', 'public');
        }
        Product::create([
            'product_name' => $request->input('product_name'),
            'product_description' => $request->input('product_description'),
            'product_price' => $request->input('product_price'),
            'category_id' => $request->input('category_id'),
            'isAvailable' => true, // Set default value for isAvailable
            'image' => $path,
        ]);
        return redirect()->back()->with('success', 'Product added successfully!');
    }

    // Update an existing product in the database
    public function update(Request $request)
    {
        try {
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

            // Handle the image upload or retain existing image path
            $path = $product->image;
            if ($request->hasFile('editImage')) {
                $path = $request->file('editImage')->store('images/products', 'public');
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

            return redirect()->route('admin.menu.products')->with('success', 'Product updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ', $e->validator->errors()->toArray());
            throw $e; // or handle the exception as needed
        }
    }

    // Delete a product from the database
    public function delete($id)
    {
        // Get the product ID from the request body
        $product = Product::findOrFail($id);
        // Optionally delete the product image from storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        // Delete the product
        $product->delete();
        // Return a JSON response for AJAX requests
        return response()->json(['message' => 'Product deleted successfully!'], 200);
    }
}
