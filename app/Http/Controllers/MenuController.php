<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class MenuController extends Controller
{
    //
    public function showCategories()
    {
        $categories = Category::withCount('products')->paginate(10);
        $products = Product::all();

        return view('admin.menu.categories', compact('categories', 'products'));
    }


    public function showProducts()
    {

        // Fetch categories from the database
        $categories = Category::all();
        $products = Product::paginate(10);


        // Return the view and pass the categories
        return view('admin.menu.products', compact('categories', 'products'));
    }


    /**
     * Show all menu
     */
    public function showMenu()
    {
        // fetch the products
        $items = Product::where('isAvailable', 1)->with('category')->get();

        // fetch the category for display in header
        $categories = Category::all();

        return view('cashier.menu.index', compact('items', 'categories'));
    }



}
