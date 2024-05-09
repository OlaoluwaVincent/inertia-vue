<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realText(20),
            'description' => fake()->realTextBetween(30, 120),
            'video_url' => fake()->url(),
            'course_id' => fake()->numberBetween(1, 20),
            'sequence' => 0,
        ];
    }
}
