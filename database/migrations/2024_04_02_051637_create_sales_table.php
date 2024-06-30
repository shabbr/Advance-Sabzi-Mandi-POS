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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('product_id');
            $table->string('seller_id');
            $table->string('vehicle');
            $table->string('sack_id');
            $table->string('quantity');
            $table->string('price');
            $table->string('cost');
            $table->string('total_product_price');
            $table->string('total_price');
            $table->integer('recieved_payment')->nullable();
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
