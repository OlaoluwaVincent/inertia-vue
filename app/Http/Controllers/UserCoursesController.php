<?php

namespace App\Http\Controllers;

use App\Class\ImageUploader;
use App\Http\Requests\CourseRequestValidator;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserCoursesController extends Controller
{
    /**
     * Display a listing of the User/Instructors Courses.
     */

    public function index(Request $request)
    {
        $user = $request->user();
        // Get the courses of the user
        $courses = Course::where('instructor_id', $user->instructor_id)->with('instructor.user')->paginate(10);
        // Return the courses to the view
        return Inertia::render('MyCourses', ['courses' => $courses]);
    }

    public function create()
    {
        return Inertia::render('Courses/CreateCourse');
    }

    public function store(CourseRequestValidator $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Check if the user is not a student
        if (!$user->isNotStudent()) {
            // Redirect to home page if the user is a student
            return Redirect::to('/');
        }

        // Validate the request data
        $validated =  $request->validated();

        // Upload the course image
        $validated['image'] = ImageUploader::course($validated['image']);

        // Create a new course record in the database
        $course = Course::create([
            // Spread the validated data
            ...$validated,
            'duration' => 0.00,
            // Set the user_id and instructor_id fields
            'user_id' => $user->id,
            'instructor_id' => $user->instructor_id,
        ]);

        $course->save();
        $category = Category::find($validated['category_id']);
        $category->courses()->save($course);


        // Redirect to the user's course page
        return Redirect::to('/my-courses/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return Inertia::render('Courses/CreateCourse', ["course" => $course]);
    }

    public function edit(Request $request, Course $course)
    {
        // Get the authenticated user
        $user = $request->user();

        // Check if the user is not a student
        if (!$user->isNotStudent()) {
            // Redirect to home page if the user is a student
            return Redirect::to('/');
        }


        // Validate the request data
        $validated =  $request->validate(
            [
                'title' => 'string|max:255',
                'description' => 'string|max:700',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                'price' => 'numeric',
                'duration' => 'numeric',
                'category_id' => 'numeric',
                'objective' => 'array',
                'requirement' => 'array',
            ]
        );
        // Upload the course image
        if ($validated['image']) {
            ImageUploader::deleteImage($course->image);
        }
        // dd($course->image);
        $course->update([
            ...$validated,
            'image' => ImageUploader::course($validated['image']) ?? $course->image,
        ]);
        $course->save();

        $category = Category::find($validated['category_id']);

        // Append the id of the course to the category_ids array

        // Update the category_ids field in the category model
        $category->save();
        // Redirect to the user's course page
        return Redirect::to('/my-courses/');
    }



    public function destroy(Course $course)
    {
        ImageUploader::deleteImage($course->image);
        $course->delete();
    }
}
