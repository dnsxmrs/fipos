<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    // Store a new category in the database
    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_name' => 'required|string|max:255',
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
        Category::create([
            'category_name' => $request->input('category_name'),
            'image' => $path,
        ]);
        return redirect()->back()->with('success', 'Product added successfully!');
    }

    // Update an existing category in the database
    public function update(Request $request)
    {
        try {
            $category_id = $request->input('editCategoryId');
            // Validate the request
            $request->validate([
                'editCategoryId' => 'required|exists:categories,category_id',
                'editCategoryName' => 'required|string|max:255',
                'editImage' => 'nullable|image|mimes:jpg,png|max:2048',
            ]);
            $category = Category::findOrFail($category_id);
            // Handle the image upload or retain existing image path
            $path = $category->image;
            if ($request->hasFile('editImage')) {
                $path = $request->file('editImage')->store('images/products', 'public');
            }
            // Update the product
            $category->update([
                'category_name' => $request->input('editCategoryName'),
                'image' => $path,
            ]);
            return redirect()->route('admin.menu.categories')->with('success', 'Product updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ', $e->validator->errors()->toArray());
            throw $e; // or handle the exception as needed
        }
    }

    // Delete a category from the database
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        // Check if there are any products associated with this category
        if ($category->products()->exists()) { // Assuming the relationship is defined as `products` in Category model
            return response()->json([
                'message' => 'Cannot delete category as it has associated products.'
            ], 400);
        }
        // Optionally delete the category image from storage
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        // Delete the category
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully!'], 200);
    }
}
