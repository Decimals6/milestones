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
        Schema::create('food_category_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categories_item_id');
            $table->unsignedBigInteger('foods_id');
            $table->timestamps();

            $table->foreign('categories_item_id')->references('id')->on('category_items')->onDelete('cascade');
            $table->foreign('foods_id')->references('id')->on('foods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_category_lists');
    }
};
