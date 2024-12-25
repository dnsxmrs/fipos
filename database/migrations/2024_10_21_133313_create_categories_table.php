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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id'); // Primary key with auto-increment
            $table->string('category_name')->unique(); // Unique category name
            $table->mediumText('description')->nullable();
            $table->enum('type', ['food', 'beverage']); // Type of category: Food or Beverage
            $table->enum('beverage_type', ['hot', 'iced'])->nullable(); // Beverage type (only for beverages)
            $table->string('image')->nullable(); // Nullable path to image
            $table->timestamps();
            $table->softDeletes('deleted_at', precision: 0); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
