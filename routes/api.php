<?php

use App\Http\Controllers\ModelControllers\CategoryController;
use App\Http\Controllers\ModelControllers\CoursesController;
use App\Http\Controllers\ModelControllers\InstructorsController;
use Illuminate\Support\Facades\Route;



Route::get('/api/courses', [CoursesController::class, 'showCourses']);
Route::get('/api/instructors', [InstructorsController::class, 'showInstructors']);
Route::get('/api/categories', [CategoryController::class, 'showCategories']);
