<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'product_name' => 'Cappuccino',
                'product_description' => 'A rich coffee with steamed milk and foam.',
                'product_price' => 4.50,
                'category_id' => 1,
                'isAvailable' => true,
                'image' => 'path/to/cappuccino.jpg',
            ],
            [
                'product_name' => 'Chocolate Chip Cookie',
                'product_description' => 'A classic cookie with gooey chocolate chips.',
                'product_price' => 1.50,
                'category_id' => 2,
                'isAvailable' => true,
                'image' => 'path/to/cookie.jpg',
            ],
            [
                'product_name' => 'Cheesecake',
                'product_description' => 'Creamy cheesecake topped with strawberries.',
                'product_price' => 5.00,
                'category_id' => 3,
                'isAvailable' => true,
                'image' => 'path/to/cheesecake.jpg',
            ],
            [
                'product_name' => 'Grilled Chicken Sandwich',
                'product_description' => 'A grilled chicken breast sandwich with lettuce and mayo.',
                'product_price' => 7.50,
                'category_id' => 4,
                'isAvailable' => true,
                'image' => 'path/to/chicken_sandwich.jpg',
            ],
            [
                'product_name' => 'Spring Rolls',
                'product_description' => 'Crispy rolls filled with fresh vegetables.',
                'product_price' => 3.00,
                'category_id' => 5,
                'isAvailable' => true,
                'image' => 'path/to/spring_rolls.jpg',
            ],
        ]);
    }
}
