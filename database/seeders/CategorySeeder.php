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
                'image' => 'assets/iced-coffee-icon.png',
                'category_name' => 'Iced Coffee',
                'type' => 'beverage',
                'updated_at' => now(),  // Add current timestamp for updated_at
            ],
            [
                'beverage_type' => 'hot',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/hot-coffee-icon.png',
                'category_name' => 'Hot Coffee',
                'type' => 'beverage',
                'updated_at' => now(),
            ],
            [
                'beverage_type' => 'iced',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/iced-non-coffee-icon.png',
                'category_name' => 'Iced Non-Coffee',
                'type' => 'beverage',
                'updated_at' => now(),
            ],
            [
                'beverage_type' => 'hot',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/hot-non-coffee-icon.png',
                'category_name' => 'Hot Non-Coffee',
                'type' => 'beverage',
                'updated_at' => now(),
            ],
            [
                'beverage_type' => 'iced',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/frappuccino-espresso-icon.png',
                'category_name' => 'Frappuccino Espresso',
                'type' => 'beverage',
                'updated_at' => now(),
            ],
            [
                'beverage_type' => 'iced',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/frappuccino-non-espresso-icon.png',
                'category_name' => 'Frappuccino Non-Espresso',
                'type' => 'beverage',
                'updated_at' => now(),
            ],
            [
                'beverage_type' => null,
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/snack-icon.png',
                'category_name' => 'Snack',
                'type' => 'food',
                'updated_at' => now(),
            ],
            [
                'beverage_type' => null,
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/dessert-icon.png',
                'category_name' => 'Dessert',
                'type' => 'food',
                'updated_at' => now(),
            ],
        ]);
    }
}
