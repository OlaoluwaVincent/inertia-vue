<?php

namespace App;

use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Lesson;

class DatabaseModelsCount
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function coursesCount()
    {
        return [
            "coursesNum" => Course::count(),
            "lessonHrs" => Course::all()->reduce(function ($carry, $course) {
                return $carry + $course->duration;
            }, 0)
        ];
    }

    public static function instructorsCount()
    {
        return Instructor::count();
    }

    public static function lessonsCount()
    {
        return Lesson::count();
    }

    /**
     * This returns all the categories that are linked to courses
     */
    public static function categoriesSubCount()
    {
        $categories = Category::all();

        // Filter categories based on the length of their category_ids array
        $filteredCategories[] = $categories->filter(function ($category) {
            return is_array($category->category_ids) && count($category->category_ids) > 0;
        });


        return $filteredCategories;
    }
}
