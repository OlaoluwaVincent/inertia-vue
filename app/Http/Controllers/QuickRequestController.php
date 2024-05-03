<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;

class QuickRequestController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
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
        $result = array_slice($result, 0, 4);
        return $result;
    }

    public function showInstructors()
    {
        $result = [];
        $instructors = Instructor::with('courses')->get();

        foreach ($instructors as $instructor) {
            $intructor_courses = [];

            foreach ($instructor->courses as $course) {
                $intructor_courses[] = [
                    'id' => $course->id,
                    'title' => $course->title,
                ];
            }

            $data = [
                'id' => $instructor->id,
                'name' => $instructor->name,
                'bio' => $instructor->bio,
                'profile' => $instructor->profile_picture,
                'instructor_courses' => $intructor_courses,
            ];

            $result[] = $data; // Append data to the result array
        }

        return $result;
    }
}
