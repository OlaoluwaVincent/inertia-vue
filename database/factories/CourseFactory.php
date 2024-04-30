<?php

namespace Database\Factories;

require_once dirname(__DIR__, 4) . '\codes\inertia-vue\vendor\autoload.php';


use App\RandomDBHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        // Add your custom provider to Faker
        fake()->addProvider(new RandomDBHelper());

        return [
            "title" => fake()->name(),
            "description" => fake()->text(),
            "image" => fake()->imageUrl($width = 640, $height = 480),
            "price" => fake()->randomFloat(2, 20, 700),
            "duration" => fake()->randomNumber(2),
            "category_id" => fake()->categoryId(),
            "instructor_id" => fake()->instructorId(),
        ];
    }
}
