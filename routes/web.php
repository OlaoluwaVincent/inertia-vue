<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModelControllers\CoursesController;
use App\Http\Controllers\ModelControllers\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCoursesController;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/cart', function () {
    return Inertia::render('Cart', ['status' => session('status')]);
})->name('cart');

Route::get('/dashboard', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/my-courses', [UserCoursesController::class, 'show'])->middleware(['auth', 'verified'])->name('user');


Route::group(['prefix' => 'my-courses'], function () {
    Route::get('/', [UserCoursesController::class, 'index'])->name('userCourse.index');
    Route::get('/{id}', [UserCoursesController::class, 'show'])->name('userCourse.show');
    Route::patch('/{id}', [UserCoursesController::class, 'edit'])->name('userCourse.edit');
    Route::post('/{id}', [UserCoursesController::class, 'store'])->name('userCourse.store');
    Route::delete('/{id}', [UserCoursesController::class, 'delete'])->name('userCourse.delte');
})->middleware(['auth', 'verified']);

Route::group(['prefix' => 'courses'], function () {
    Route::get('/', [CoursesController::class, 'index'])->name('course.show');

    Route::get('/{id}', [CoursesController::class, 'show'])->name('course.single');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'reviews'], function () {
    Route::get('/{id}', [ReviewController::class, 'show'])->name('review.show');
    Route::post('/{id}', [ReviewController::class, 'store'])->middleware('auth')->name('review.store');
    Route::delete('/{id}', [ReviewController::class, 'destroy'])->middleware('auth')->name('review.destroy');
    Route::get('/', [ReviewController::class, 'index'])->name('review.index');
});

Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback']);
Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->middleware(HandleCors::class)->name('pay');

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
