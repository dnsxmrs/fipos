<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('inventory_categories')->insert([
            [
                'category_name' => 'Coffee Beans',
                'description' => 'Includes raw ingredients such as Arabica and Robusta beans.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Packaging Materials',
                'description' => 'Includes packaging such as cups, lids, and straws.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Dairy Products',
                'description' => 'Milk, cream, and plant-based milk alternatives.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Sweeteners',
                'description' => 'Sugar, syrups, and artificial sweeteners.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Tea Ingredients',
                'description' => 'Tea leaves, tea bags, and matcha powder.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Flavoring and Toppings',
                'description' => 'Syrups, cocoa powder, cinnamon, and whipped cream.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
