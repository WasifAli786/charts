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
        Schema::create('trade_histories', function (Blueprint $table) {
            $table->id();
            $table->char('call', 4);
            $table->float('priceperunit');
            $table->integer('quantity');
            $table->date('date')->default(now());
            $table->time('time')->default(now());

            $table->unsignedBigInteger('trades_id');
            $table->unsignedBigInteger('stock_id');
            $table->foreign('trades_id')->references('id')->on('trades')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_histories');
    }
};
