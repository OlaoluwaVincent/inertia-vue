<?php

namespace Database\Factories;

use App\RandomDBHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compliment>
 */
class ComplimentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new RandomDBHelper());

        return [
            'comment' => fake()->realTextBetween(200, 400),
            'user_id' => fake()->userId()
        ];
    }
}
