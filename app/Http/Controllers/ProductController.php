<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display form to create a new product\
    // return view/page
    public function create()
    {
        return view('products.create'); // Shows the create form view
    }

    // Store a new product in the database
    // Add item to database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    // Display a listing of the products
    // Show all products
    public function index()
    {
        $products = Product::all(); // Fetch all products from the database
        return view('products.index', compact('products')); // Shows the product list
    }

    // Search for a product
    // Single/multiple search
    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('product_name', 'like', '%' . $search . '%')
                ->orWhere('product_id', $search);
        }

        $products = $query->paginate(10);
        return view('products.index', compact('products'));
    }

    // Show the details of a single product
    public function show($id)
    {
        $product = Product::findOrFail($id); // Fetch the specific product
        return view('products.show', compact('product')); // Shows the product details
    }

    // Show the form for editing an existing product
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Fetch the specific product
        return view('products.edit', compact('product')); // Shows the edit form
    }

    // Update an existing product in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $imagePath = $product->image; // Keep existing image if not replaced
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Delete a product from the database
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete(); // Delete the product
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
