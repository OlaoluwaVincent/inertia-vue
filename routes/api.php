<?php

use App\Http\Controllers\ModelControllers\ComplimentsController;
use App\Http\Controllers\ModelControllers\CategoryController;
use App\Http\Controllers\ModelControllers\CoursesController;
use App\Http\Controllers\ModelControllers\InstructorsController;
use Illuminate\Support\Facades\Route;



Route::get('/api/popular/courses', [CoursesController::class, 'showCourses']);
Route::get('/api/popular/instructors', [InstructorsController::class, 'showPopularInstructors']);
Route::get('/api/popular/categories', [CategoryController::class, 'showPopularCategories']);
Route::get('/api/compliments', [ComplimentsController::class, 'showCompliments']);
