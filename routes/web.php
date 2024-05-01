<?php

use App\DatabaseModelsCount;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'coursesCount' => DatabaseModelsCount::coursesCount()['coursesNum'],
        'lessonHrs' => DatabaseModelsCount::coursesCount()['lessonHrs'],
        'instructorsCount' => DatabaseModelsCount::instructorsCount(),
        'categories' => DatabaseModelsCount::categoriesSubCount(),
    ]);
});




Route::get('/dashboard', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
