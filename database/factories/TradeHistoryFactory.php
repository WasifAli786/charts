<?php

namespace Database\Factories;

use App\Models\Trades;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=TradeHistory>
 */
class TradeHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $trade = Trades::inRandomOrder()->first();

        return [
            'trades_id' => $trade->id,
            'call' => fake()->randomElement(['buy', 'sell']),
            'priceperunit' => fake()->randomFloat(2, 1, 100),
            'quantity' => fake()->numberBetween(1, 100),
            'date' => fake()->date(),
            'time' => fake()->time(),
            'stock_id' => $trade->stock_id
        ];
    }
}
