<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::factory()->count(10)->create();


        // Iterate over the courses
        foreach ($courses as $course) {
            // Find the category associated with the course
            $category = Category::find($course->category_id);

            // If the category is found, associate the course with it
            if ($category) {
                // Fetch existing category_ids array or initialize an empty array
                $category_ids = $category->category_ids ?? [];

                // Append the id of the course to the category_ids array
                $category_ids[] = $course->id;

                // Update the category_ids field in the category model
                $category->category_ids = $category_ids;
                $category->save();
            }
        }
    }
}
