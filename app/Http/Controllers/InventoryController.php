<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InventoryController extends Controller
{
    /**
     *  Get the items from the microservice
     */
    public function showItems()
    {
        $response = Http::get('http://127.0.0.1:8081/inventory/get');

        if ($response->failed()) {

            return response()->json([
                'message' => 'Failed to get the items'
            ], 500);

        }

        $items = $response->json()['items'];
        $categories = $response->json()['categories'];

        return view('admin.inventory.index', compact('items', 'categories'));
    }


    /**
     *  Get the categorized items
     */
    public function showCategorizedItems($name) {

        $response = Http::get('http://127.0.0.1:8081/inventory/get/' . $name);

        if ($response->failed()) {

            return response()->json([
                'message' => 'Failed to get the items'
            ], 500);

        }

        $categorizedItems = $response->json()['categorizedItems'];
        $categories = $response->json()['categories'];

        return view('admin.inventory.categorized', compact('categorizedItems', 'categories'));
    }
}
