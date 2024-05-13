<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::where('user_id', $request->user()->id)->with('user')->orderBy('created_at', 'desc')->paginate(10);
        return Inertia::render("Reviews", ['reviews' => $reviews, 'status' => session('status'),]);
    }

    public function show($id)
    {
        $allReviews = Review::where('course_id', $id)->with('user')->orderBy('created_at')->get();
        if (!$allReviews) {
            return ['message', abort(404)];
        }
        $totalRating = Review::where('course_id', $id)->sum('rating');
        $totalRatingsCount = Review::where('course_id', $id)->count('user_id');
        $averageRating = $totalRatingsCount > 0 ? $totalRating / $totalRatingsCount : 0;


        // Append the total rating and average rating to the response
        $total_raters = $totalRatingsCount;
        $average_rating = $averageRating;
        return [
            'reviews' => $allReviews,
            "total_raters" => $total_raters,
            "average_rating" => $average_rating,
        ];
    }
    public function store(Request $request, $id)
    {
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
        } catch (ModelNotFoundException $e) {
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
    public function destroy(Review $id)
    {
        $isDeleted = $id->delete();

        if ($isDeleted) {
            return Redirect::route('review.index')->with('status', 'Successful');
        } else {
            return Redirect::route('review.index')->with('status', 'Failed');
        }
    }
}
