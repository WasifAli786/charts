<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->char('symbol', 255);
            $table->char('status', 6);
            $table->date('date');
            $table->time('time');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('stock_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
