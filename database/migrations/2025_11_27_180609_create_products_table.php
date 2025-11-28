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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Product name should normally be unique
            $table->string('image')->nullable(); // Allows product without an image initially
            $table->unsignedInteger('amount')->default(0); // Stock can’t be negative
            $table->decimal('price', 10, 2); // Best for money storage
            $table->boolean('is_active')->default(true); // Fixed typo & added default
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
