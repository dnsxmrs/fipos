<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            [
                'name' => 'Cappuccino',
                'description' => 'A rich coffee with steamed milk and foam.',
                'price' => 4.50,
                'category_id' => 1, // Assuming 1 is the ID for Beverages
                'availability' => true,
                'image' => 'path/to/cappuccino.jpg',
            ],
            [
                'name' => 'Chocolate Chip Cookie',
                'description' => 'A classic cookie with gooey chocolate chips.',
                'price' => 1.50,
                'category_id' => 2, // Assuming 2 is the ID for Snacks
                'availability' => true,
                'image' => 'path/to/cookie.jpg',
            ],
            [
                'name' => 'Cheesecake',
                'description' => 'Creamy cheesecake topped with strawberries.',
                'price' => 5.00,
                'category_id' => 3, // Assuming 3 is the ID for Desserts
                'availability' => true,
                'image' => 'path/to/cheesecake.jpg',
            ],
            [
                'name' => 'Grilled Chicken Sandwich',
                'description' => 'A grilled chicken breast sandwich with lettuce and mayo.',
                'price' => 7.50,
                'category_id' => 4, // Assuming 4 is the ID for Meals
                'availability' => true,
                'image' => 'path/to/chicken_sandwich.jpg',
            ],
            [
                'name' => 'Spring Rolls',
                'description' => 'Crispy rolls filled with fresh vegetables.',
                'price' => 3.00,
                'category_id' => 5, // Assuming 5 is the ID for Appetizers
                'availability' => true,
                'image' => 'path/to/spring_rolls.jpg',
            ],
        ]);
    }
}
