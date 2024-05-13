<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModelControllers\CoursesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CorsMiddleware;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/cart', function () {
    return Inertia::render('Cart');
})->name('cart');

Route::get('/dashboard', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['prefix' => 'courses'], function () {
    Route::get('/', [CoursesController::class, 'index'])->name('course.show');

    Route::get('/{id}', [CoursesController::class, 'show'])->name('course.single');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback']);
Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->middleware(CorsMiddleware::class)->name('pay');

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
