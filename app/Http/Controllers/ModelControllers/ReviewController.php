<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function show($id)
    {
        $reviews = Review::where('course_id', $id)->with('user')->orderBy('created_at')->get();
        if (!$reviews) {
            return ['message', abort(404)];
        }
        return $reviews;
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
            return ['message' => "You cannot create a Review for this course"];
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
    public function destroy(Review $review)
    {
        $review->delete();
        return ['message' => 'deleted successfully'];
    }
}
