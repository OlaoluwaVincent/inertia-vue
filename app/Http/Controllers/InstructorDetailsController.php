<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructorDetailsValidate;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InstructorDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return Inertia::render('Profile/InstructorDetails', [
            'isOnBoard' => $user->hasOnboarded(),
            'details' => auth()->user()->instructor
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(InstructorDetailsValidate $request)
    {
        $user = $request->user();

        if (!$user->isNotStudent()) {
            throw new Exception('Forbidden Access');
        }
        // Fill the User model with the validated fields
        $validated = $request->validated();
        $instructor = Instructor::create(
            [
                'user_id' => $user->id,
                'headline' => $validated['headline'],
                'expertise' => $validated['expertise'],
                'professional_experience' => $validated['professional_experience'],
                'languages' => $validated['languages']
            ]
        );



        $user->instructor_id = $instructor->id;
        $user->save();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstructorDetailsValidate $request, Instructor $instructor)
    {
        $validated = $request->validated();

        if (!$validated) {
            throw new Exception('All Fields are required');
        }

        $instructor->update([
            ...$validated
        ]);
    }

    public function show(User $id)
    {

        $user = $id;
        $courses = Course::where('instructor_id', $user->instructor_id)->get();

        $user->courses = $courses;

        return Inertia::render('Instructor', [
            'details' => $user,
        ]);
    }
}
