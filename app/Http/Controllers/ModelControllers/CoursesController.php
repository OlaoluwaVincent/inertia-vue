<?php

namespace App\Http\Controllers\ModelControllers;

use App\Class\ImageUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequestValidator;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CoursesController extends Controller
{

    /**  all the Courses view with the courses data */
    public function index(Request $request)
    {
        // Retrieve query parameters
        $category = $request->query('category');
        $price = $request->query('price');
        $sort = $request->query('sort');

        $query = Course::with('instructor.user');


        // Filter courses by category if category is provided
        if ($category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('id', $category);
            });
        }

        // Filter courses by price range if price is provided
        if ($price) {
            $query->where('price', '<=', $price);
        }



        // Paginate the results
        $courses = $query->paginate(10);
        // return $courses;

        // Return view with courses
        return Inertia::render('Courses/AllCourses', [
            'courses' => $courses,
        ]);
    }

    public function form(Request $request)
    {
        $user = $request->user();
        if (!$user->isNotStudent()) {
            return Redirect::to('/');
        }

        return Inertia::render('Courses/CreateCourse');
    }

    public function store(CourseRequestValidator $request)
    {
        $user = $request->user();
        dd($request->files)->image;
        if (!$user->isNotStudent()) {
            return Redirect::to('/');
        }

        $validated =  $request->validated();
        // $validated['image'] = ImageUploader::course($validated['image']);

        $course = Course::create([
            ...$validated,
            'user_id' => $user->id,
            'instructor_id' => $user->instructor_id,
        ]);

        return Redirect::to('/my-course/' . $user->id);
    }

    /** the Course view with the course data {category, course, instructor} */
    public function show($id)
    {
        $course = Course::with('category', 'instructor.user', 'lessons', 'reviews',)->find($id);

        return Inertia::render('Courses/SingleCourse', [
            'course' => $course,
        ]);
    }

    /**
     * This returns all the courses and their related Instructors
     */
    public function popularCourse()
    {
        $courses = Course::with('instructor.user')->get();
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
                'instructor' => $item['instructor'],
            ];

            // Push the modified object into the result array
            $result[] = $newItem;
        }
        return array_slice($result, 0, 5);
    }

    public static function coursesCount()
    {
        return [
            "coursesNum" => Course::count(),
            "lessonHrs" => Course::all()->reduce(function ($carry, $course) {
                return $carry + $course->duration;
            }, 0)
        ];
    }
}
