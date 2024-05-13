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
            $table->string('product_name');
            $table->string('product_sku')->nullable();
            $table->string('product_unit')->nullable();
            $table->string('product_unit_value')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('discount')->nullable();
            $table->string('tax')->nullable();
            $table->string('product_image')->nullable();
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
