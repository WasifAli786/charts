<?php

namespace Database\Factories;

use App\Models\Stocks;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TradesFactory extends Factory
{
    public function definition(): array
    {
        $stock = Stocks::inRandomOrder()->first();

        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'symbol' => $stock->symbol,
            'status' => fake()->randomElement(['open', 'win', 'loss']),
            'date' => fake()->dateTimeBetween('-1 months', 'now'),
            'time' => fake()->time(),
            'stock_id' => $stock->id
        ];
    }
}
