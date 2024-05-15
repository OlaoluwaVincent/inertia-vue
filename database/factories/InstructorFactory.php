<?php

namespace Database\Factories;

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
        return [
            // 'followers' => fake(),
            'headline' => 'Frontend Developer at WorldTech',
            'professional_experience' => fake()->realTextBetween(200, 300),
            // 'expertise' => fake(),
            // 'languages' => fake(),
            'user_id' => 23,
        ];
    }
}
