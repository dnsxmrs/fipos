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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid();
            $table->string('item_name');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->decimal('stock', 8, 2);
            $table->string('unit');
            $table->unsignedInteger('reorder_level');
            $table->timestamp('last_restocked')->nullable();
            $table->date('expiry_date')->nullable();
            $table->enum('status', ['sufficient', 'low', 'expired', 'critical', 'damaged', 'discontinued'])->default('sufficient');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
