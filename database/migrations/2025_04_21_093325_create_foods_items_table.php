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
        Schema::create('foods_items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->double('price')->nullable();
            $table->foreignId('category_item_id')->constrained('categories_item')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods_items');
    }
};
