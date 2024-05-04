<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructor;

class InstructorsController extends Controller
{
    /**
     * This returns all the instructors and their related courses
     */
    public function showPopularInstructors()
    {
        $results = [];
        $instructors = Instructor::with('courses')->get();

        // Sort the instructors by the highest number of courses
        $sortedInstructors = $instructors->sortByDesc(function ($instructor) {
            return count($instructor->courses);
        });

        foreach ($sortedInstructors as $instructor) {
            $data = [
                'id' => $instructor->id,
                'name' => $instructor->name,
                'bio' => $instructor->bio,
                'profile' => $instructor->profile_picture,
                'instructor_courses' => count($instructor->courses),
            ];

            $results[] = $data;
        }
        return array_slice($results, 0, 5);
    }


    public static function instructorsCount()
    {
        return Instructor::count();
    }
}
