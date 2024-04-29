<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
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

    public function run()
    {
        foreach (self::categories as $categoryName) {
            Category::create(['name' => $categoryName]);
        }
    }
}
