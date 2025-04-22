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
        Schema::create('foods_categories_list', function (Blueprint $table) {
            $table->foreignId('food_id')->constrained('foods')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('category_item_id')->constrained('categories_item')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods_categories_list');
    }
};
