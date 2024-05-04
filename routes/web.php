<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModelControllers\CategoryController;
use App\Http\Controllers\ModelControllers\CoursesController;
use App\Http\Controllers\ModelControllers\InstructorsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'coursesCount' => CoursesController::coursesCount()['coursesNum'],
        'lessonHrs' => CoursesController::coursesCount()['lessonHrs'],
        'instructorsCount' => InstructorsController::instructorsCount(),
        'categories' => CategoryController::showPopularCategories(),
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/courses', function () {
    return Inertia::render('Courses/AllCourses');
})->name('course.show');

Route::get('/courses/{id}', function () {
    return Inertia::render('Courses/SingleCourse');
})->name('course.single');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
