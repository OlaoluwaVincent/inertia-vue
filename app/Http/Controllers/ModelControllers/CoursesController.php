<?php

namespace App\Http\Controllers\ModelControllers;

use App\Class\EnrollmentCheckers;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CoursesController extends Controller
{
    /**  all the Courses view with the courses data */
    public function index(Request $request): Response
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
    public function show(Request $request, $id):Response
    {
        $user_id = $request->user() ? $request->user()->id : null;

        $hasEnrolled = EnrollmentCheckers::hasEnrolled($user_id, $id);

        // $course = EnrollmentCheckers::enrolledCourse($user_id, $id);
        $course = Course::with('category', 'instructor.user', 'lessons', 'reviews',)->find($id);
        $course['lessons']->transform(
            function ($lesson) {
                unset($lesson->video_url);
                return $lesson;
            }
        );
        $students_count = Enrollment::where('course_id', $id)->count();

        $course->reviewsAverage();
        $course['students_count'] = $students_count;

        return Inertia::render('Courses/SingleCourse', [
            'course' => $course,
            'hasEnrolled' => $hasEnrolled,

        ]);
    }

    ##Get Course by Search
    public function search(Request $request):JsonResponse
    {
        $query = $request->input('query');

        // Perform a search on the Course model
        $courses = Course::whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($query) . '%'])->with('instructor.user')->paginate(10);

        return response()->json($courses);
    }

    /**
     * This returns all the courses and their related Instructorse
     */
    public function popularCourse():array
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

    public static function coursesCount(): array
    {
        return [
            "coursesNum" => Course::count(),
            "lessonHrs" => Course::all()->reduce(function ($carry, $course) {
                return $carry + $course->duration;
            }, 0)
        ];
    }
}
