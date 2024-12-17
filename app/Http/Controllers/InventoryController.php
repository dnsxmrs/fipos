<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InventoryController extends Controller
{
    /**
     *  Get the items from the microservice
     */
    public function showItems()
    {
        $categories = InventoryCategory::all();
        $items = Item::with('category')->get();

        return view('admin.inventory.index', compact('items', 'categories'));
    }


    /**
     *  Get the categorized items
     */
    public function showCategorizedItems($name)
    {
        // get the category with the given name
        $category = InventoryCategory::where('category_name', $name)->first();

        $categories = InventoryCategory::all();
        $categorizedItems = Item::where('category_id', $category->id)
            ->with('category')
            ->get();

        return view('admin.inventory.categorized', compact('categorizedItems', 'categories'));
    }
}
