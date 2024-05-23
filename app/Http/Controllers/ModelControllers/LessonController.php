<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function showRelated($instructor_id)
    {
        $courses = Course::where('instructor_id', $instructor_id)->with('instructor.user')->get();
        $courses->each(function ($course) {
            $course->reviewsAverage();
        });

        return $courses;
    }
}
