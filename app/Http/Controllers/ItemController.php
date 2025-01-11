<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    /**
     *  Store new item
     */
    public function store(Request $request)
    {
        $item = $request->validate([

            'item_name' => 'required|string|max:255',
            'category' => 'required|exists:inventory_categories,id',
            'stock' => 'required|numeric',
            'unit' => 'required|in:kg,liters,pcs',
            'reorder_level' => 'required|numeric',
            'expiration_date' => 'nullable'

        ]);

        $isCreated = Item::create([
            'item_name' => $item['item_name'],
            'category_id' => $item['category'],
            'stock' => $item['stock'],
            'unit' => $item['unit'],
            'reorder_level' => $item['reorder_level'],
            'last_restocked' => now(),
            'expiry_date' => Carbon::createFromFormat('m/d/Y', $item['expiration_date'])->format('Y-m-d'),
        ]);

        if ($isCreated) {
            return redirect()->back()->with('status_add', 'Item created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to store item');
        }
    }


    /**
     *  Update item in the database
     */
    public function update(Request $request)
    {
        try {

            $item = $request->validate([
                'edit_item_id' => 'required|exists:items,id',
                'edit_item_name' => 'required|string|max:255',
                'edit_category' => 'required|exists:inventory_categories,id',

            ]);

            $itemToUpdate = Item::find($item['edit_item_id']);

            $isUpdated = $itemToUpdate->update([

                'item_name' => $item['edit_item_name'],
                'category_id' => $item['edit_category']

            ]);

            if ($isUpdated) {

                return redirect()->back()->with('status_edit', 'Item updated successfully');
            } else {

                return redirect()->back()->with('error', 'Failed to update the item');
            }
        } catch (ValidationException $th) {

            dd($th);
        }
    }


    /**
     *  Soft deletes an item
     */
    public function destroy(Request $request)
    {

        $item = $request->validate([
            'item_id' => 'required|exists:items,id'
        ]);

        $itemToDelete = Item::find($item['item_id']);

        $isDeleted = $itemToDelete->update([
            'deleted_at' => now()
        ]);

        if ($isDeleted) {
            return redirect()->back()->with('success_delete', 'Item successfully deleted.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the item');
        }
    }
}
