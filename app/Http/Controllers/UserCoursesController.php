<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserCoursesController extends Controller
{
    /**
     * Display a listing of the User/Instructors Courses.
     */

    public function index(Request $request)
    {
        // Get the ID of the authenticated user
        $instructor_id = $request->user()->instructor_id;

        // Course::with('instructor.user')->paginate(10);
        $courses = Course::where('instructor_id', $instructor_id)->with('instructor.user')->paginate(10);
        // Return the courses to the view
        return Inertia::render('MyCourses', ['courses' => $courses]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
