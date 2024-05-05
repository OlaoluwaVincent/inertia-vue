<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * This returns a list of all categories and its associated courses
     */

    public static function showPopularCategories()
    {
        // Get all categories with the count of associated courses
        $categories = Category::withCount('courses')->get();

        // Sort the categories by the highest number of courses
        $sortedCategories = $categories->sortByDesc('courses_count');
        $categories = json_decode($sortedCategories, true);
        $firstFiveItems = array_slice($categories, 0, 4);
        $firstFiveJson = json_encode($firstFiveItems);

        return $firstFiveJson;
    }

    public static function show()
    {
        $categories = Category::all();
        return $categories;
    }
}
