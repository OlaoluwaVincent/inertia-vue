<?php

namespace Database\Factories;

use App\RandomDBHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstructorFactory extends Factory
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
            // 'followers' => fake(),
            'headline' => fake()->realText(40),
            'professional_experience' => fake()->realTextBetween(200, 300),
            // 'expertise' => fake(),
            // 'languages' => fake(),
            'user_id' => fake()->userInstructorId(),
        ];
    }
}
