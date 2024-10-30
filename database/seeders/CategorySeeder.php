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
                'category_name' => 'Beverages',
                'image' => 'images/products/beverages.jpg'
            ],
            [
                'category_name' => 'Desserts',
                'image' => 'images/products/desserts.jpg'
            ],
            [
                'category_name' => 'Cakes',
                'image' => 'images/products/cakes.jpg'
            ],
            [
                'category_name' => 'Sandwiches',
                'image' => 'images/products/sandwiches.jpg'
            ],
            [
                'category_name' => 'Appetizers',
                'image' => 'images/products/appetizers.jpg'
            ],
        ]);
    }
}
