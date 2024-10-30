<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class MenuController extends Controller
{
    //
    public function categories()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::all();

        return view('admin.menu.categories', compact('categories', 'products'));
    }
    public function products()
    {

        // Fetch categories from the database
        $categories = Category::all();
        $products = Product::all();

        // Return the view and pass the categories
        return view('admin.menu.products', compact('categories', 'products'));
    }
}
