<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            [
                'beverage_type' => 'iced',
                'created_at' => now(),
                'deleted_at' => null,  // Add null value for deleted_at
                'image' => 'images/categories/iced-coffee.png',
                'category_name' => 'Iced Coffee',
                'type' => 'beverage',
                'updated_at' => now(),  // Add current timestamp for updated_at
                'description' => 'Refreshing iced coffee options perfect for a warm day.',
            ],
            [
                'beverage_type' => 'hot',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'images/categories/hot-coffee.png',
                'category_name' => 'Hot Coffee',
                'type' => 'beverage',
                'updated_at' => now(),
                'description' => 'Classic hot coffee varieties to warm you up.',
            ],
            [
                'beverage_type' => 'iced',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'images/categories/frappe.png',
                'category_name' => 'Blended Coffee (Frappes)',
                'type' => 'beverage',
                'updated_at' => now(),
                'description' => 'Deliciously blended frappes for a sweet treat.',
            ],
            [
                'beverage_type' => 'hot',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'images/categories/non-coffee.png',
                'category_name' => 'Non-Coffee Beverages',
                'type' => 'beverage',
                'updated_at' => now(),
                'description' => 'Hot beverages for those who prefer alternatives to coffee.',
            ],
            [
                'beverage_type' => null,
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'images/categories/pastries.png',
                'category_name' => 'Pastries',
                'type' => 'food',
                'updated_at' => now(),
                'description' => 'A selection of freshly baked pastries to complement your drink.',
            ],
            [
                'beverage_type' => null,
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'images/categories/snacks.png',
                'category_name' => 'Snacks',
                'type' => 'food',
                'updated_at' => now(),
                'description' => 'Tasty snacks to satisfy your cravings.',
            ],
        ]);
    }
}
