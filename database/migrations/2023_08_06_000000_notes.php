<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('heading', 300);
            $table->string('content', 1200);
            $table->string('type', 20);
            $table->unsignedBigInteger('trades_id');
            $table->foreign('trades_id')->references('id')->on('trades')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
