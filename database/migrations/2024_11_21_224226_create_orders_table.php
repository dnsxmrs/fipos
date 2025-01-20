<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->enum('order_type', ['dine-in', 'take-out', 'online']);
            $table->decimal('total_price', 10, 2);
            $table->decimal('tax_amount', 10, 2);
            $table->enum('discount_type', ['none', 'senior citizen', 'pwd'])->default('none');
            $table->decimal('discount_amount', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->unsignedBigInteger('user_id'); // user that processed the order
            $table->enum('status', ['pending', 'preparing', 'ready', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

            // foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->noActionOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
