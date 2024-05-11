<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function show(Review $review)
    {
        $reviews = Review::where("id", $review)->get();
        return $reviews;
    }
    public function store(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            "comment" => "required|string|max:255",
            'rating' => "required",
        ]);


        try {
            $course = Course::findOrFail(900);
        } catch (ModelNotFoundException $e) {
            return back()->with("message", "You cannot leave a review for this");
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

        return back()->with('message', 'Created');
    }


    public function destroy(Review $review)
    {
        $review->delete();
        return ['message' => 'deleted successfully'];
    }
}
