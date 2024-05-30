<?php

namespace App\Http\Controllers\ModelControllers;

use App\Class\EnrollmentCheckers;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
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
        $rating = $request->query('rating');

        // Start building the query without executing it
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

        // Paginate the results after processing
        $courses = $query->paginate(10);

        // Iterate through each course to calculate average ratings
        foreach ($courses->items() as $course) {
            $course->reviewsAverage();
        }


        // Return view with paginated courses
        return Inertia::render('Courses/AllCourses', [
            'courses' => $courses,
        ]);
    }

    /** the Course view with the course data {category, course, instructor} */
    public function show(Request $request, $id)
    {
        $user_id = $request->user() ? $request->user()->id : null;

        $hasEnrolled = EnrollmentCheckers::hasEnrolled($user_id, $id);

        $course = EnrollmentCheckers::enrolledCourse($user_id, $id);
        $course->reviewsAverage();

        return Inertia::render('Courses/SingleCourse', [
            'course' => $course,
            'hasEnrolled' => $hasEnrolled,
        ]);
    }

    /**
     * This returns all the courses and their related Instructors
     */
    public function popularCourse()
    {
        $courses = Course::with('instructor.user')->take(5)->get();

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
                'fullname' => $item['instructor']['user']['fullname'],
            ];

            // Push the modified object into the result array
            $result[] = $newItem;
        }
        return $result;
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
