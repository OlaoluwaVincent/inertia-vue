<?php

namespace App\Traits;

use App\Models\Course;
use App\Models\Review;

trait CourseTrait
{
    public function reviewsAverage(?Course $course = null)
    {
        $courseObject = $course ?? $this;

        $reviews = Review::where('course_id', $courseObject->id)->get();
        $ratings = $reviews->pluck('rating')->toArray();

        if (empty($ratings)) {
            return null; // Return null if there are no ratings
        }

        $average = array_sum($ratings) / count($ratings);
        $courseObject->avg_rating = $average;
        $courseObject->avg_voters = count($ratings);
        return;

        // return $average;
    }
}
