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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('order_time')->useCurrent();
            $table->double('total_price');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['Received', 'INPROGRESS', 'READY', 'COMPLETED']);
            $table->enum('type', ['DINEIN', 'TAKEAWAY']);
            $table->unsignedBigInteger('payments_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payments_id')->references('id')->on('payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
