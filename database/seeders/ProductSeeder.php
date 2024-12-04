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
            // Iced Coffee
            [
                'product_name' => 'Americano',
                'product_description' => 'A strong black coffee with a bold flavor.',
                'product_price' => 3.50,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/americano.jpg',
                'category_id' => 1, // Iced Coffee
                'created_at' => now(),
            ],
            [
                'product_name' => 'Sweetened Americano',
                'product_description' => 'A rich Americano with added sweetness.',
                'product_price' => 3.75,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/sweetened_americano.jpg',
                'category_id' => 1, // Iced Coffee
                'created_at' => now(),
            ],

            // Hot Coffee
            [
                'product_name' => 'Americano',
                'product_description' => 'A smooth and strong espresso with hot water.',
                'product_price' => 3.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/hot_americano.jpg',
                'category_id' => 2, // Hot Coffee
                'created_at' => now(),
            ],
            [
                'product_name' => 'Cafe Latte',
                'product_description' => 'A creamy espresso with steamed milk and a touch of foam.',
                'product_price' => 3.50,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/cafe_latte.jpg',
                'category_id' => 2, // Hot Coffee
                'created_at' => now(),
            ],

            // Iced Non-Coffee
            [
                'product_name' => 'Choco',
                'product_description' => 'A refreshing iced chocolate drink.',
                'product_price' => 3.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/choco.jpg',
                'category_id' => 3, // Iced Non-Coffee
                'created_at' => now(),
            ],
            [
                'product_name' => 'Strawberry Milk',
                'product_description' => 'A sweet and creamy strawberry milkshake.',
                'product_price' => 3.25,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/strawberry_milk.jpg',
                'category_id' => 3, // Iced Non-Coffee
                'created_at' => now(),
            ],

            // Hot Non-Coffee
            [
                'product_name' => 'Choco',
                'product_description' => 'A warm and comforting hot chocolate.',
                'product_price' => 2.50,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/hot_choco.jpg',
                'category_id' => 4, // Hot Non-Coffee
                'created_at' => now(),
            ],

            // Frappuccino Espresso
            [
                'product_name' => 'Java Chip',
                'product_description' => 'A rich frappuccino blended with chocolate chips and espresso.',
                'product_price' => 4.50,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/java_chip.jpg',
                'category_id' => 5, // Frappuccino Espresso
                'created_at' => now(),
            ],
            [
                'product_name' => 'Caramel',
                'product_description' => 'A smooth frappuccino with caramel and a hint of coffee.',
                'product_price' => 4.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/caramel_frappuccino.jpg',
                'category_id' => 5, // Frappuccino Espresso
                'created_at' => now(),
            ],

            // Frappuccino Non-Espresso
            [
                'product_name' => 'Choco Hazelnut',
                'product_description' => 'A delicious blend of chocolate and hazelnut in a frappuccino.',
                'product_price' => 4.25,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/choco_hazelnut.jpg',
                'category_id' => 6, // Frappuccino Non-Espresso
                'created_at' => now(),
            ],
            [
                'product_name' => 'Strawberry Delight',
                'product_description' => 'A refreshing strawberry frappuccino with creamy texture.',
                'product_price' => 4.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/strawberry_delight.jpg',
                'category_id' => 6, // Frappuccino Non-Espresso
                'created_at' => now(),
            ],

            // Snack
            [
                'product_name' => 'Fries',
                'product_description' => 'Crispy golden fries served with a dipping sauce.',
                'product_price' => 2.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/fries.jpg',
                'category_id' => 7, // Snack
                'created_at' => now(),
            ],
            [
                'product_name' => 'Big Siomai',
                'product_description' => 'Delicious steamed dumplings filled with pork and spices.',
                'product_price' => 2.50,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/big_siomai.jpg',
                'category_id' => 7, // Snack
                'created_at' => now(),
            ],

            // Dessert
            [
                'product_name' => 'Chocolate Chip Cookie',
                'product_description' => 'A soft and chewy chocolate chip cookie.',
                'product_price' => 1.50,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/chocolate_chip_cookie.jpg',
                'category_id' => 8, // Dessert
                'created_at' => now(),
            ],
            [
                'product_name' => 'Compfire S\'mores Cookie',
                'product_description' => 'A delicious cookie filled with marshmallows, chocolate, and graham cracker crumbs.',
                'product_price' => 2.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/compfire_smores_cookie.jpg',
                'category_id' => 8, // Dessert
                'created_at' => now(),
            ],
        ]);
    }
}
