<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use Illuminate\Http\Request;

class InventoryCategoryController extends Controller
{
    /**
     *  Stores new category
     */
    public function store(Request $request)
    {

        $category = $request->validate([

            'category_name' => 'required|string|max:255',
            'description' => 'nullable'

        ]);


        if (InventoryCategory::create($category)) {

            return redirect()->back()->with('status', 'Inventory category created successfully!');
        } else {

            return redirect()->back()->with('error', 'Failed to create category.');
        }
    }

    public function showEdit($id) {

        $category = InventoryCategory::find($id)->first();

        return view('admin.inventory.category.modals.edit-modal', compact('category'));

    }


    /**
     * Update category
     */
    public function update(Request $request)
    {
        // Validate the incoming request data
        $category = $request->validate([
            'editCategoryId' => 'required|exists:categories,category_id', // Ensure 'editCategoryId' exists
            'category_name' => 'required|string|max:255', // Category name is required and should be a string
            'description' => 'nullable|string', // Description is optional and should be a string if provided
        ]);

        // Find the category to update (use findOrFail to handle missing category)
        $categoryToUpdate = InventoryCategory::findOrFail($category['editCategoryId']);

        // Attempt to update the category
        $statusEdit = $categoryToUpdate->update([
            'category_name' => $category['category_name'],  // Update category name
            'description' => $category['description'] ?? null,  // Update description or set null if empty
        ]);

        // Redirect based on the update status
        if ($statusEdit) {
            return redirect()->back()->with('status', 'Inventory category updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update category.');
        }
    }
}
