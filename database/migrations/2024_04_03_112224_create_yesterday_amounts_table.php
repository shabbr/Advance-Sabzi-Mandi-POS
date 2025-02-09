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
        Schema::create('yesterday_amounts', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('recieved_amount');
            $table->date('yesterday');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yesterday_amounts');
    }
};
