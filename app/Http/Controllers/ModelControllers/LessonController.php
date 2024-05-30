<?php

namespace App\Http\Controllers\ModelControllers;

use App\Class\VideoUploader;
use App\Events\UpdateDuration;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LessonController extends Controller
{

    public function index(Course $course)
    {
        $lessons = $course->lessons;
        return Inertia::render('Lessons/Lessons', ['course' => $course, 'lessons' => $lessons,]);
    }

    public function create(Request $request)
    {
        $course_query =  $request->query('course');
        $lesson_query =  $request->query('lesson');
        $user = $request->user();

        if (!$user->isNotStudent()) {
            return Redirect::to(route("dashboard"));
        };
        $lesson = Lesson::find(intval($lesson_query));

        $user_courses = Course::where("instructor_id", $user->instructor_id)->select('id', 'title')->get();
        return Inertia::render(
            "Lessons/AddLesson",
            ['courses_snippet' => $user_courses, 'course_query' => $course_query, 'lessons' => $lesson ? $lesson : null]
        );
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

        Redirect::to("/my-courses/lesson/" . $course->id);
    }

    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'course_id' => 'numeric',
            'description' => 'string|max:700',
            'video' => 'nullable|file|mimetypes:video/mp4,video/mpeg,video/quicktime,video/x-msvideo,video/x-flv,video/x-ms-wmv,video/3gpp,video/x-matroska,application/octet-stream'
        ]);

        $video_url = $lesson->video_url;

        if ($validated['video']) {
            VideoUploader::deleteVideo($lesson->video_url);
            $video_url = VideoUploader::saveVideo($validated['video']);
        }

        UpdateDuration::dispatch($course, $validated['video']);

        $lesson->update([
            ...$validated,
            'video_url' => $video_url,
        ]);
    }


    public function destroy(Course $course, Lesson $lesson)
    {
        $video_deleted = VideoUploader::deleteVideo($lesson->video_url);
        if (!$video_deleted) {
            throw new Exception('Error Deleting Lesson');
        }

        $deleted = Lesson::where('course_id', $course->id)
            ->where('id', $lesson->id)
            ->delete();

        if (!$deleted) {
            throw new Exception('Error Deleting Lesson');
        }
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
