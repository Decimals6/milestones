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
        Schema::create('order_details_options', function (Blueprint $table) {
            $table->foreignId('order_detail_id')->constrained('order_details')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('food_item_id')->constrained('foods_items')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details_options');
    }
};
