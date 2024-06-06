<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthCheckers;
use App\Models\Course;
use App\Models\Review;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ReviewController extends Controller
{
    /**
     * Returns all the Users Reviews
     */
    public function index(AuthCheckers $request): Response
    {
        if ($request->isInstructor()) {
            if (!$request->user()->hasOnboarded()) {
                return Inertia::render("Reviews", ['reviews' => ['data' => []], 'status' => session('status'),]);
            }

            $instructors_courses = $request->user()->instructor->courses;
            $reviews = null;

            foreach ($instructors_courses as $course) {
                // Paginate the reviews for each course
                $$reviews = $course->reviews()->with('user', 'course')->paginate(10);
            }
            // For Certified Instructors
            return Inertia::render("Reviews", ['reviews' => $reviews, 'status' => session('status'), 'canDelete' => $request->isAdmin()]);
        } else {
            // For Students
            $reviews = Review::where('user_id', $request->user()->id)->with('user')->orderBy('created_at', 'desc')->paginate(10);
            return Inertia::render("Reviews", ['reviews' => $reviews, 'status' => session('status'),]);
        }
    }

    /**
     * Returns all the reviews on a course.
     *
     * @return array [
     *     'totalRaters' => The total number of raters,
     *     'averageRaters' => The average rating,
     *     'reviews' => An array containing all the reviews,
     * ];
     */
    public function show($id): array
    {
        $allReviews = Review::where('course_id', $id)->with('user')->orderBy('created_at')->get();
        if (!$allReviews) {
            return ['message', abort(404)];
        }
        // $totalRating = Review::where('course_id', $id)->sum('rating');
        // $totalRatingsCount = Review::where('course_id', $id)->count('user_id');
        // $averageRating = $totalRatingsCount > 0 ? $totalRating / $totalRatingsCount : 0;

        $ratings = $allReviews->pluck('rating')->toArray();
        $average = !empty($ratings) ? array_sum($ratings)  / count($ratings) : 0;


        // Append the total rating and average rating to the response
        // $total_raters = $totalRatingsCount;
        // $average_rating = $averageRating;
        return [
            'reviews' => $allReviews,
            "total_raters" => count($ratings),
            "average_rating" => $average,
        ];
    }

    /**
     * @throws Exception
     */
    public function store(AuthCheckers $request, $id): array|Collection|\Illuminate\Support\Collection
    {
        if ($request->isInstructor()) {
            throw new Exception("Only Students can do this", 401);
        }
        // Validate the request
        $requestValidated = $request->validate([
            "comment" => "required|string|max:255",
            'rating' => "required",
        ]);

        if (!$requestValidated) {
            return $requestValidated;
        }

        try {
            $course = Course::findOrFail($id);
        } catch (ModelNotFoundException) {
            return ['message', abort(404)];
        }

        // If you reach this point, the course was found
        // Create the review associated with the user and the course
        $review = new Review([
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);
        $review->user()->associate($request->user());
        $review->course()->associate($course);
        $review->save();

        return Review::where('course_id', $id)->with('user')->orderBy('created_at')->get();
    }
    public function destroy(Review $id): RedirectResponse
    {
        $isDeleted = $id->delete();

        if ($isDeleted) {
            return Redirect::route('review.index')->with('status', 'Successful');
        } else {
            return Redirect::route('review.index')->with('status', 'Failed');
        }
    }
}
