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


    /**
     * Show all menu
     */
    public function showMenu()
    {
        // fetch the products
        $items = Product::all();

        // fetch the category for display in header
        $categories = Category::all();

        return view('cashier.menu.all-menu', compact('items', 'categories'));
    }

    /**
     * Show menu per category
     */
    public function showCategorizedMenu($category_id)
    {
        // find products with the certain category
        $products = Product::where('category_id', $category_id)->get();
        $categories = Category::all();


        // return fetched data to view
        return view('cashier.menu.categorized-menu', compact('products', 'categories'));
    }


}
