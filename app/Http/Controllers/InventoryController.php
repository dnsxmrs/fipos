<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InventoryController extends Controller
{
    /**
     *  Show the items
     */
    public function showItems()
    {
        $categories = InventoryCategory::all();
        $items = Item::with('category')->withoutTrashed()->paginate(10);

        return view('admin.inventory.item.items', compact('items', 'categories'));
    }

    /**
     *  Show the categories
     */
    public function showCategories()
    {
        $categories = InventoryCategory::withCount('items')->paginate(10);

        return view('admin.inventory.category.categories', compact('categories'));
    }


    // /**
    //  *  Get the categorized items
    //  */
    // public function showCategorizedItems($name)
    // {
    //     // get the category with the given name
    //     $category = InventoryCategory::where('category_name', $name)->first();

    //     $categories = InventoryCategory::all();
    //     $categorizedItems = Item::where('category_id', $category->id)
    //         ->with('category')
    //         ->get();

    //     return view('admin.inventory.categorized', compact('categorizedItems', 'categories'));
    // }
}
