<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
            return redirect()->back()->with('status_add', 'Inventory category created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create category.');
        }
    }


    public function showEdit($id)
    {
        $category = InventoryCategory::find($id)->first();

        return view('admin.inventory.category.modals.edit-modal', compact('category'));
    }


    /**
     * Update category
     */
    public function update(Request $request)
    {
        try {
            $category = $request->validate([
                'editCategoryId' => 'required|exists:inventory_categories,id',
                'categoryName' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $categoryToUpdate = InventoryCategory::find($category['editCategoryId']);

            $isUpdated = $categoryToUpdate->update([
                'category_name' => $category['categoryName'],  // Update category name
                'description' => $category['description'] ?? null,  // Update description or set null if empty
            ]);

            if ($isUpdated) {
                return redirect()->back()->with('status_edit', 'Category updated successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update the category');
            }
        } catch (ValidationException $th) {

            dd($th);
        }
    }


    /**
     *  Soft deletes a category
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'delete_category_id' => 'required|exists:items,id',
            'password' => 'required'
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            $categoryToDelete = InventoryCategory::find($request->delete_category_id);

            if ($categoryToDelete) {
                $categoryToDelete->delete();
                return redirect()->back()->with('status_deleted', 'Category deleted successfully');
            }

            return redirect()->back()->with('error', 'Failed to delete the category');
        }

        return redirect()->back()->with('error', 'Password don\'t match.');
    }
}
