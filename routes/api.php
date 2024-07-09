<?php

use App\Http\Controllers\LessonProgressController;
use App\Http\Controllers\ModelControllers\ComplimentsController;
use App\Http\Controllers\ModelControllers\CategoryController;
use App\Http\Controllers\ModelControllers\CoursesController;
use App\Http\Controllers\ModelControllers\InstructorsController;
use App\Http\Controllers\ModelControllers\LessonController;
use App\Http\Controllers\ModelControllers\ReviewController;
use Illuminate\Support\Facades\Route;



Route::get('/popular/courses', [CoursesController::class, 'popularCourse']);
Route::get('/popular/instructors', [InstructorsController::class, 'showPopularInstructors']);
Route::get('/popular/categories', [CategoryController::class, 'showPopularCategories']);


Route::get('/categories', [CategoryController::class, 'show']);
Route::get('/compliments', [ComplimentsController::class, 'showCompliments']);
Route::get('/coursescount', [CoursesController::class, 'coursesCount']);
Route::get('/instructorsCount', [InstructorsController::class, 'instructorsCount']);


Route::get('/relatedcourses/{instructor_id}', [LessonController::class, 'showRelated']);

Route::group(['prefix' => 'reviews'], function () {
    Route::get('/{id}', [ReviewController::class, 'show'])->name('review.show-api');
    Route::post('/{id}', [ReviewController::class, 'store'])->middleware('auth')->name('review.store-api');
    Route::delete('/{id}', [ReviewController::class, 'destroy'])->middleware('auth')->name('review.destroy-api');
});


Route::group(['prefix'=>'progress'], function(){
    Route::get('/{lesson}', [LessonProgressController::class, 'show'])->middleware('auth')->name('progress_lesson');
    Route::post('/{lesson}', [LessonProgressController::class, 'store'])->middleware('auth')->name('progress_lesson-post');
});
