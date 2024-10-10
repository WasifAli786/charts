<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->smallInteger('class')->default(0);
            $table->string('profile_image')->default('OIP.jpeg');
            $table->timestamp('created_at')->default(now());
            $table->integer('total_investment')->default(20000);
            $table->rememberToken();
        });

        User::create([
            'name' => 'Wasif',
            'email' => 'wasifboss77777@gmail.com',
            'password' => 'wasifboss77777$%$',
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
