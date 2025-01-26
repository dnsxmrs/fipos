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
        DB::table('products')->insert([
            // Iced Coffee
            [
                'name' => 'Americano',
                'description' => 'A strong black coffee with a bold flavor.',
                'price' => 3.50,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/americano.jpg',
                'category_number' => 1, // Iced Coffee
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sweetened Americano',
                'description' => 'A rich Americano with added sweetness.',
                'price' => 3.75,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/sweetened_americano.jpg',
                'category_number' => 1, // Iced Coffee
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Hot Coffee
            [
                'name' => 'Americano',
                'description' => 'A smooth and strong espresso with hot water.',
                'price' => 3.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/hot_americano.jpg',
                'category_number' => 2, // Hot Coffee
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cafe Latte',
                'description' => 'A creamy espresso with steamed milk and a touch of foam.',
                'price' => 3.50,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/cafe_latte.jpg',
                'category_number' => 2, // Hot Coffee
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Iced Non-Coffee
            [
                'name' => 'Choco',
                'description' => 'A refreshing iced chocolate drink.',
                'price' => 3.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/choco.jpg',
                'category_number' => 3, // Iced Non-Coffee
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Strawberry Milk',
                'description' => 'A sweet and creamy strawberry milkshake.',
                'price' => 3.25,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/strawberry_milk.jpg',
                'category_number' => 3, // Iced Non-Coffee
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Hot Non-Coffee
            [
                'name' => 'Choco',
                'description' => 'A warm and comforting hot chocolate.',
                'price' => 2.50,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/hot_choco.jpg',
                'category_number' => 4, // Hot Non-Coffee
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Frappuccino Espresso
            [
                'name' => 'Java Chip',
                'description' => 'A rich frappuccino blended with chocolate chips and espresso.',
                'price' => 4.50,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/java_chip.jpg',
                'category_number' => 5, // Frappuccino Espresso
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Caramel',
                'description' => 'A smooth frappuccino with caramel and a hint of coffee.',
                'price' => 4.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/caramel_frappuccino.jpg',
                'category_number' => 5, // Frappuccino Espresso
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Frappuccino Non-Espresso
            [
                'name' => 'Choco Hazelnut',
                'description' => 'A delicious blend of chocolate and hazelnut in a frappuccino.',
                'price' => 4.25,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/choco_hazelnut.jpg',
                'category_number' => 6, // Frappuccino Non-Espresso
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Strawberry Delight',
                'description' => 'A refreshing strawberry frappuccino with creamy texture.',
                'price' => 4.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'assets/strawberry_delight.jpg',
                'category_number' => 6, // Frappuccino Non-Espresso
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Snack
            [
                'name' => 'Fries',
                'description' => 'Crispy golden fries served with a dipping sauce.',
                'price' => 2.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/fries.jpg',
                'category_number' => 7, // Snack
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Big Siomai',
                'description' => 'Delicious steamed dumplings filled with pork and spices.',
                'price' => 2.50,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/big_siomai.jpg',
                'category_number' => 7, // Snack
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dessert
            [
                'name' => 'Chocolate Chip Cookie',
                'description' => 'A soft and chewy chocolate chip cookie.',
                'price' => 1.50,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/chocolate_chip_cookie.jpg',
                'category_number' => 8, // Dessert
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Compfire S\'mores Cookie',
                'description' => 'A delicious cookie filled with marshmallows, chocolate, and graham cracker crumbs.',
                'price' => 2.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'assets/compfire_smores_cookie.jpg',
                'category_number' => 8, // Dessert
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
