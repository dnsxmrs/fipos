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
            $table->string('name')->unique(); // Unique name for each product
            $table->text('description')->nullable(); // Nullable description
            $table->decimal('price', 8, 2); // Price with 2 decimal places
            $table->unsignedBigInteger('category_id')->nullable(); // Nullable foreign key to category
            $table->boolean('availability')->default(true); // Availability defaulting to true
            $table->string('image')->nullable(); // Nullable path to image
            $table->timestamps();

            // Foreign key constraint for category_id
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
