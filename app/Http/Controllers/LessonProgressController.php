<?php

namespace App\Http\Controllers;

use App\Enums\LessonProgressEnum;
use App\Models\LessonProgress;
use Illuminate\Http\Request;

class LessonProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $lesson):LessonProgress
    {
        $duration = $request['duration'] ?? 0;
            return LessonProgress::updateOrCreate([
                'user_id' => $request->user()->id,
                'course_id' => $request['course_id'],
                'lesson_id' => $request['id'],
                'duration' => $duration,
                'status' => LessonProgressEnum::from($request['status']),
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(LessonProgress $lessonProgress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LessonProgress $lessonProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LessonProgress $lessonProgress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LessonProgress $lessonProgress)
    {
        //
    }
}
