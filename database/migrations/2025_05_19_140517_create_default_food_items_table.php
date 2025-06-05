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
        Schema::create('default_food_items', function (Blueprint $table) {
            $table->id('idDefault_Foods_Item');
            $table->unsignedBigInteger('foods_items_id');
            $table->unsignedBigInteger('foods_id');
            $table->timestamps();

            $table->foreign('foods_items_id')->references('id')->on('food_items')->onDelete('cascade');
            $table->foreign('foods_id')->references('id')->on('foods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_food_items');
    }
};
