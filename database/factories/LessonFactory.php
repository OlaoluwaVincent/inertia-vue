<?php

namespace Database\Factories;

use App\RandomDBHelper;
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
        fake()->addProvider(new RandomDBHelper());
        return [
            'title' => fake()->realText(20),
            'description' => fake()->realTextBetween(30, 120),
            'video_url' => fake()->url(),
            'course_id' => fake()->courseId(),
            'sequence' => 0,
        ];
    }
}
