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

    public function showCategories()
    {
        $categories = Category::all();
        return $categories;
    }
}
