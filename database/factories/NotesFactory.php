<?php

namespace Database\Factories;

use App\Models\Trades;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notes>
 */
class NotesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'heading' => fake()->text(60),
            'content' => fake()->text(1200),
            'type' => fake()->randomElement(['setup', 'mistake']),
            'trades_id' => Trades::inRandomOrder()->value('id')
        ];
    }
}
