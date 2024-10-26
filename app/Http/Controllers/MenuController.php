<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function categories()
    {
        return view('admin.menu.categories');
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
