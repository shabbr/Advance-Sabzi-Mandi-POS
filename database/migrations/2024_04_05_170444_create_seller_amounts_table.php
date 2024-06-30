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
        Schema::create('seller_amounts', function (Blueprint $table) {
            $table->id();
            $table->string('seller_id');
            $table->string('vehicle');
            // $table->string('product_id');
            $table->date('payment_of_date');
            $table->string('total_amount');
            $table->string('commision');
            $table->string('fare');
            $table->string('labour_charges');
            $table->string('market_fee');
            $table->string('clerkly');
            $table->string('total_expenses');
            $table->string('pure_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_amounts');
    }
};
