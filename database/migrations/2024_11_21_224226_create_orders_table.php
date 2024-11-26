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
            $table->enum('order_type', ['dine-in', 'take out']);
            $table->decimal('total_price', 10, 2);
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('user_id'); // user that processed the order
            $table->enum('status', ['pending', 'preparing', 'ready', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
            $table->softDeletes('deleted_at', precision: 0);

            // foreign key constraints
            $table->foreign('payment_id')->references('id')->on('payments')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->noActionOnDelete();

            // index for better query performance
            $table->index('payment_id');
            $table->index('user_id');
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