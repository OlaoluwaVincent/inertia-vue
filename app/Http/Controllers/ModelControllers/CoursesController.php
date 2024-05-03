<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * This returns all the courses and their related Instructors
     */
    public function showCourses()
    {
        $courses = Course::with('instructor')->get();
        $result = [];

        foreach ($courses as $item) {
            // Create a new object with required keys
            $newItem = [
                'id' => $item['id'],
                'title' => $item['title'],
                'description' => $item['description'],
                'image' => $item['image'],
                'price' => $item['price'],
                'duration' => $item['duration'],
                'instructor' => [
                    'id' => $item['instructor']['id'],
                    'name' => $item['instructor']['name']
                ]
            ];

            // Push the modified object into the result array
            $result[] = $newItem;
        }
        return array_slice($result, 0, 5);
    }
}
