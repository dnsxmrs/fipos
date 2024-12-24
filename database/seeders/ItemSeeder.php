<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'item_name' => 'Arabica Coffee Beans',
                'category_id' => 1, // Coffee Beans
                'stock' => 50.00,
                'unit' => 'kg',
                'reorder_level' => 10,
                'last_restocked' => now(),
                'expiry_date' => '2025-12-31',
                'status' => 'sufficient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Espresso Cups',
                'category_id' => 2, // Packaging Materials
                'stock' => 1000.00,
                'unit' => 'pcs',
                'reorder_level' => 200,
                'last_restocked' => now(),
                'expiry_date' => null,
                'status' => 'sufficient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Whole Milk',
                'category_id' => 3, // Dairy Products
                'stock' => 20.00,
                'unit' => 'liters',
                'reorder_level' => 5,
                'last_restocked' => now(),
                'expiry_date' => '2024-12-20',
                'status' => 'sufficient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Brown Sugar',
                'category_id' => 4, // Sweeteners
                'stock' => 30.50,
                'unit' => 'kg',
                'reorder_level' => 5,
                'last_restocked' => now(),
                'expiry_date' => '2026-01-15',
                'status' => 'sufficient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Green Tea Leaves',
                'category_id' => 5, // Tea Ingredients
                'stock' => 15.00,
                'unit' => 'kg',
                'reorder_level' => 3,
                'last_restocked' => now(),
                'expiry_date' => '2025-11-30',
                'status' => 'low',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Vanilla Syrup',
                'category_id' => 6, // Flavoring and Toppings
                'stock' => 10.00,
                'unit' => 'liters',
                'reorder_level' => 2,
                'last_restocked' => now(),
                'expiry_date' => '2025-06-30',
                'status' => 'sufficient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
