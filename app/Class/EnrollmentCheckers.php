<?php

namespace App\Class;

use App\Models\Course;
use App\Models\Enrollment;

class EnrollmentCheckers
{

    public static function hasEnrolled($user_id, $course_id): bool
    {
        $enrollment = Enrollment::where('user_id', $user_id)->where('course_id', $course_id)->first();
        if (is_null($enrollment)) {
            return false;
        }
        return true;
    }

    public static function enrolledCourse($user_id, $course_id)
    {
        $course = null;
        if (is_null($user_id) || !self::hasEnrolled($user_id, $course_id)) {
            $course = Course::with('category', 'instructor.user', 'lessons', 'reviews',)->find($course_id);
            $course->lessons->transform(
                function ($lesson) {
                    unset($lesson->video_url);
                    return $lesson;
                }
            );
        }
        if (self::hasEnrolled($user_id, $course_id)) {
            $course =  Course::with('category', 'instructor.user', 'lessons', 'reviews',)->find($course_id);
        }

        return $course;
    }
}
