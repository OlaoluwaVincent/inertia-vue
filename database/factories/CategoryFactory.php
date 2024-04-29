<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->unique()->randomElements(self::categories)
        ];
    }


    private const categories = [
        'Programming & Development',
        'Business & Entrepreneurship',
        'Personal Development',
        'Marketing',
        'IT & Software',
        'Design',
        'Photography & Video',
        'Music',
        'Language',
        'Health & Fitness',
        'Finance & Accounting',
        'Teaching & Academics',
        'Lifestyle',
        'Arts & Crafts',
        'Writing & Content Creation',
        'Culinary Arts',
        'Parenting & Relationships',
        'Science',
        'Engineering',
        'Test Preparation'
    ];
}
