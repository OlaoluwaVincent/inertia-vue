<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Instructor;

class InstructorsController extends Controller
{
    /**
     * This returns all the instructors and their related courses
     */
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
