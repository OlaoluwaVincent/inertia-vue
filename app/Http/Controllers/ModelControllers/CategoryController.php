<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{
    /**
     * This returns a list of all categories and its associated courses
     */

    public static function showPopularCategories()
    {

        // Get all categories with the count of associated courses
        return Category::whereHas('courses')->select('id', 'name')->get();
    }

    public static function show()
    {
        return Category::withCount('courses')
            ->orderBy('courses_count', 'desc')
            ->get();
    }
}
