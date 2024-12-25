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
        DB::table('products')->insert([
            // Iced Coffee
            [
                'product_name' => 'Iced Americano',
                'product_description' => 'Refreshing iced espresso with water and ice.',
                'product_price' => 150.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'images/products/iced-americano.png',
                'category_id' => 1, // Iced Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Iced Latte',
                'product_description' => 'A smooth blend of espresso, cold milk, and ice.',
                'product_price' => 180.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/iced-latte.png',
                'category_id' => 1, // Iced Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Iced Caramel Macchiato',
                'product_description' => 'Iced espresso with caramel syrup and milk.',
                'product_price' => 190.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/iced-caramel-macchiato.png',
                'category_id' => 1, // Iced Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Iced Mocha',
                'product_description' => 'A delicious combination of iced espresso and chocolate syrup.',
                'product_price' => 200.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/iced-mocha.png',
                'category_id' => 1, // Iced Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Iced Flat White',
                'product_description' => 'Iced espresso with steamed milk for a creamy taste.',
                'product_price' => 170.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/iced-flat-white.png',
                'category_id' => 1, // Iced Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Hot Coffee
            [
                'product_name' => 'Hot Espresso',
                'product_description' => 'Strong hot espresso shot with rich flavor.',
                'product_price' => 120.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'images/products/hot-espresso.png',
                'category_id' => 2, // Hot Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Hot Cappuccino',
                'product_description' => 'A balanced blend of espresso, steamed milk, and foam.',
                'product_price' => 160.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/hot-cappuccino.png',
                'category_id' => 2, // Hot Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Hot Latte',
                'product_description' => 'Espresso with steamed milk, topped with foam.',
                'product_price' => 180.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/hot-latte.png',
                'category_id' => 2, // Hot Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Hot Mocha',
                'product_description' => 'A delightful combination of hot espresso and chocolate syrup.',
                'product_price' => 190.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/hot-mocha.png',
                'category_id' => 2, // Hot Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Hot Macchiato',
                'product_description' => 'Espresso with a small amount of steamed milk and foam.',
                'product_price' => 150.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/hot-macchiato.png',
                'category_id' => 2, // Hot Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Blended Coffee (Frappes)
            [
                'product_name' => 'Espresso Frappuccino',
                'product_description' => 'Blended ice with espresso, milk, and a hint of sweetness.',
                'product_price' => 200.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/espresso-frappuccino.png',
                'category_id' => 3, // Blended Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Caramel Frappuccino',
                'product_description' => 'Blended ice with espresso, caramel syrup, and milk.',
                'product_price' => 210.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/caramel-frappuccino.png',
                'category_id' => 3, // Blended Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Chocolate Frappuccino',
                'product_description' => 'Blended ice with espresso and chocolate syrup.',
                'product_price' => 220.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/chocolate-frappuccino.png',
                'category_id' => 3, // Blended Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Vanilla Frappuccino',
                'product_description' => 'Blended ice with espresso and vanilla flavor.',
                'product_price' => 230.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/vanilla-frappuccino.png',
                'category_id' => 3, // Blended Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Mocha Frappuccino',
                'product_description' => 'Blended ice with espresso, chocolate syrup, and milk.',
                'product_price' => 240.00,
                'isAvailable' => true,
                'has_customization' => true,
                'image' => 'images/products/mocha-frappuccino.png',
                'category_id' => 3, // Blended Coffee category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Pastries
            [
                'product_name' => 'Chocolate Cake',
                'product_description' => 'Rich and moist chocolate cake.',
                'product_price' => 120.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'images/products/chocolate-cake.png',
                'category_id' => 5, // Pastries category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Strawberry Cheesecake',
                'product_description' => 'Creamy cheesecake topped with fresh strawberries.',
                'product_price' => 150.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'images/products/strawberry-cheesecake.png',
                'category_id' => 5, // Pastries category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Vegan Chocolate Cake',
                'product_description' => 'Delicious and rich vegan chocolate cake.',
                'product_price' => 130.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'images/products/vegan-chocolate-cake.png',
                'category_id' => 5, // Pastries category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Lemon Meringue Pie',
                'product_description' => 'Tangy lemon filling with a fluffy meringue topping.',
                'product_price' => 140.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'images/products/lemon-meringue-pie.png',
                'category_id' => 5, // Pastries category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Tiramisu',
                'product_description' => 'Classic Italian dessert with layers of coffee-soaked ladyfingers.',
                'product_price' => 160.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'images/products/tiramisu.png',
                'category_id' => 5, // Pastries category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Snacks
            [
                'product_name' => 'Garlic Bread',
                'product_description' => 'Toasted bread with garlic butter and herbs.',
                'product_price' => 80.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'images/products/garlic-bread.png',
                'category_id' => 6, // Snacks category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'French Fries',
                'product_description' => 'Crispy fried potato strips served with ketchup.',
                'product_price' => 90.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'images/products/french-fries.png',
                'category_id' => 6, // Snacks category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Onion Rings',
                'product_description' => 'Crispy battered onion rings, perfect as a snack.',
                'product_price' => 100.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'images/products/onion-rings.png',
                'category_id' => 6, // Snacks category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Mozzarella Sticks',
                'product_description' => 'Deep-fried mozzarella cheese sticks.',
                'product_price' => 120.00,
                'isAvailable' => true,
                'has_customization' => false,
                'image' => 'images/products/mozarella-sticks.png',
                'category_id' => 6, // Snacks category ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
