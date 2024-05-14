<?php

namespace App\Http\Controllers;

use App\Class\UserClass;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserCoursesController extends Controller
{
    /**
     * Display a listing of the User/Instructors Courses.
     */
    public function index(Request $request, UserClass $user)
    {

        $courses = Course::where("user_id", $request->user()->id)->get();

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
