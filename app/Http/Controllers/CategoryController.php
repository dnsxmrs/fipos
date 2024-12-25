<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class CategoryController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,jpeg|max:2048', // Validation
        ]);

        $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();

        return response()->json(['url' => $uploadedFileUrl]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload image to Cloudinary if present
        if ($request->hasFile('image')) {
            $path = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        } else {
            $path = null;
        }

        // Create the category
        $category = Category::create([
            'category_name' => $request->input('category_name'),
            'type' => 'beverage',
            'beverage_type' => 'hot',
            'image' => $path, // Save Cloudinary URL or null
        ]);

        // Sync with OOS after category creation
        $this->syncWithOos('POST', $category);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Category added successfully!');
    }


    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'editCategoryId' => 'required|exists:categories,category_id',
            'category_name' => 'required|string|max:255',
            'editImage' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        $category = Category::findOrFail($request->input('editCategoryId'));

        // Upload image to Cloudinary if present
        if ($request->hasFile('editImage')) {
            $path = Cloudinary::upload($request->file('editImage')->getRealPath())->getSecurePath();
        } else {
            $path = $category->image ? $category->image : null;
        }

        // Update the category
        $category->update([
            'category_name' => $request->input('category_name'),
            'type' => 'beverage',
            'beverage_type' => 'hot',
            'image' => $path,
        ]);

        // log the update and the category object
        // Log::info('Category updated:', [
        //     'category' => $category,
        // ]);

        // Sync with OOS after category update
        $this->syncWithOos('PUT', $category);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        // Check if there are any products associated with this category
        if ($category->products()->exists()) {
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

        // Sync with OOS after category deletion
        $this->syncWithOos('DELETE', $category);

        return response()->json(['message' => 'Category deleted successfully!'], 200);
    }

    // Sync with OOS after category operation (create, update, delete)
    protected function syncWithOos(string $method, $category)
    {
        $url = 'http://127.0.0.1:8000/api/webhook/category-update'; // Change to your OOS API endpoint

        // Prepare the data to send to OOS
        $data = [
            'category_number' => $category->category_id,
            'category_name' => $category->category_name,
            'type' => $category->type,
            'beverage_type' => $category->beverage_type,
            'image_url' => $category->image // Store full URL path for OOS
        ];

        Log::info('Sending data to OOS:', [
            'method' => $method,
            'url' => $url,
            'category_number' => $category->category_id,
            'category_name' => $category->category_name,
            'type' => $category->type,
            'beverage_type' => $category->beverage_type,
            'image_url' => $category->image // Store full URL path for OOS
        ]);

        // Perform the HTTP request to sync with OOS
        try {
            $response = Http::send($method, $url, [
                'json' => $data,
            ]);

            if ($response->failed()) {
                \Log::error('Failed to sync with OOS', [
                    'method' => $method,
                    'url' => $url,
                    'status' => $response->status(),
                    'message' => $response->body(),
                ]);
            } else {
                \Log::info('Successfully synced with OOS', [
                    'method' => $method,
                    'url' => $url,
                    'status' => $response->status(),
                    'message' => $response->body(),
                ]);
            }

        } catch (\Exception $e) {
            \Log::error('Error syncing with OOS', [
                'error' => $e->getMessage(),
                'method' => $method,
                'url' => $url,
            ]);
        }
    }
}
