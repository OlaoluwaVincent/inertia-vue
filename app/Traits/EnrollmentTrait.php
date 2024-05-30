<?php

namespace App\Traits;

use App\Models\Enrollment;

trait EnrollmentTrait
{
    // Check if a user has enrolled for a course
    public function hasEnrolled($user_id, $course_id): bool
    {

        return $this->user_id === $user_id && $this->course_id === $course_id;
    }
}
