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
        Schema::create('buyed_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
             $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
             $table->string('vehicle');
             $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('sack_id');
            $table->foreign('sack_id')->references('id')->on('custom_sacks')->onDelete('cascade');
            $table->string('quantity');
            $table->string('remaining');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyed_products');
    }
};
