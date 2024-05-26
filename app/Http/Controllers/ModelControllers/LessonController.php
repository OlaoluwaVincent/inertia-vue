<?php

namespace App\Http\Controllers\ModelControllers;

use App\Class\VideoUploader;
use App\Events\UpdateDuration;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LessonController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();
        if (!$user->isNotStudent()) {
            return Redirect::to(route("dashboard"));
        };
        $user_courses = Course::where("instructor_id", $user->instructor_id)->select('id', 'title')->get();
        return Inertia::render("Lessons/AddLesson", ['courses' => $user_courses]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|numeric',
            'description' => 'required|string|max:700',
            'video' => 'required|file|mimetypes:video/mp4,video/mpeg,video/quicktime,video/x-msvideo,video/x-flv,video/x-ms-wmv,video/3gpp,video/x-matroska,application/octet-stream'
        ]);

        $course = Course::findOrFail($validated['course_id']);
        $video_url = VideoUploader::saveVideo($validated['video']);

        Lesson::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'video_url' => $video_url,
            'course_id' => $validated['course_id']
        ]);

        UpdateDuration::dispatch($course, $validated['video']);

        return Redirect::to('dashboard');
    }


    public function showRelated($instructor_id)
    {
        $courses = Course::where('instructor_id', $instructor_id)->with('instructor.user')->get();
        $courses->each(function ($course) {
            $course->reviewsAverage();
        });

        return $courses;
    }
}
