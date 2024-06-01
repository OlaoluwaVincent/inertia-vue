<?php

namespace App;

use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;

class RandomDBHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function categoryId()
    {
        return Category::inRandomOrder()->first()->id;
    }

    /**
     * This gets random id from the instructorDB and returns it
     * @return int<string, mixed>
     */
    public function userId()
    {
        return User::inRandomOrder()->first()->id;
    }
    public function userInstructorId()
    {
        return $user = User::inRandomOrder()
            ->whereNull('instructor_id')
            ->where('role', 'INSTRUCTOR')
            ->first()->id;
    }



    /**
     * This gets random id from the instructorDB and returns it
     *
     * @return int<string, mixed>
     */
    public function instructorId()
    {
        return Instructor::inRandomOrder()->first()->id;
    }
    public function courseId()
    {
        return Course::inRandomOrder()->first()->id;
    }
}
