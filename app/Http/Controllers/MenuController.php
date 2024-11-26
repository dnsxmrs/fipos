<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class MenuController extends Controller
{
    //
    public function showCategories()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::all();

        return view('admin.menu.categories.categories', compact('categories', 'products'));
    }


    public function showProducts()
    {

        // Fetch categories from the database
        $categories = Category::all();
        $products = Product::all();

        // Return the view and pass the categories
        return view('admin.menu.products.products', compact('categories', 'products'));
    }
}
