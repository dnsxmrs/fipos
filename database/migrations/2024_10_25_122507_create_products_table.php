<?php
// database/migrations/xxxx_xx_xx_create_products_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key column with unique, auto-incremented ID
            $table->string('product_name'); // Unique name for each product
            $table->text('product_description')->nullable(); // Nullable description
            $table->decimal('product_price', 10, 2); // Price with 2 decimal places
            $table->boolean('isAvailable')->default(true); // Availability flag (default: true)
            // $table->boolean('has_customization')->default(false); // Customization flag (default: false)
            $table->string('image')->nullable(); // Nullable image for the product
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key to category
            $table->timestamps();
            $table->softDeletes('deleted_at', precision: 0);

            // Foreign key constraint for category_id
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
