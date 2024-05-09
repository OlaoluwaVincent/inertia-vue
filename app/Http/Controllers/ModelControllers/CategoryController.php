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
        $notNullCategory = [];

        foreach ($categories as $category) {
            if ($category->category_ids !== null) {
                // Append the category data to the $notNullCategory array
                $notNullCategory[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                    'category_ids' => $category->category_ids,
                ];
            }
        }

        return $notNullCategory;
    }

    public static function show()
    {
        $categories = Category::all();
        return $categories;
    }
}
