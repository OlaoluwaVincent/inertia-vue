<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstructorDetailsController;
use App\Http\Controllers\ModelControllers\CoursesController;
use App\Http\Controllers\ModelControllers\LessonController;
use App\Http\Controllers\ModelControllers\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCoursesController;
use App\Http\Controllers\WatchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});
Route::get('/email', function (Request $request) {
    $data = [
        ['title' => 'name of the course'],
        ['title' => 'name of another course']
    ];
    return view('email.PurchaseEmail', [
        'user' => $request->user(),
        'metadata' => $data,
        'total' => 200
    ]);
});

Route::get('/cart', CartController::class)->name('cart');

Route::get('/dashboard', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/details/{id}', [InstructorDetailsController::class, 'show'])->name('userDetails');


Route::group(['prefix' => 'my-details', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [InstructorDetailsController::class, 'index'])->name('userDetails.index');
    Route::patch('/{instructor}', [InstructorDetailsController::class, 'edit'])->name('userDetails.edit');
    Route::post('/', [InstructorDetailsController::class, 'store'])->name('userDetails.store');
});
## Details for Instructor

Route::group(['prefix' => 'my-courses', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [UserCoursesController::class, 'index'])->name('userCourse.index');

    Route::get('/create', [UserCoursesController::class, 'create'])->name('userCourse.create');
    Route::post('/create', [UserCoursesController::class, 'store'])->name('userCourse.store');
    Route::get('/edit/{course}', [UserCoursesController::class, 'show'])->name('userCourse.show');
    Route::post('/edit/{course}', [UserCoursesController::class, 'edit'])->name('userCourse.edit');
    Route::delete('/{course}', [UserCoursesController::class, 'destroy'])->name('userCourse.delete');

    Route::get('/lesson/create', [LessonController::class, 'create'])->name('lesson.create'); // /Show the Create Lesson Page
    Route::post('/lesson', [LessonController::class, 'store'])->name('lesson.store'); // Store a new Lesson
    Route::get('/lesson/{course}', [LessonController::class, 'index'])->name('lesson.index'); // Show all lessons assigned to a course
    Route::post('course/{course}/lesson/{lesson}', [LessonController::class, 'update'])->name('lesson.update'); // Update an existing lesson
    Route::delete('course/{course}/lesson/{lesson}', [LessonController::class, 'destroy'])->name('lesson.destroy'); // Delete a lesson
});


Route::group(['prefix' => 'courses'], function () {
    Route::get('/', [CoursesController::class, 'index'])->name('course.show');
    Route::get('/search-courses', [CoursesController::class, 'search'])->name('courses.search');
    Route::get('/{id}', [CoursesController::class, 'show'])->name('course.single');
    Route::delete('/{id}', [CoursesController::class, 'delete'])->name('course.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.patch');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'reviews'], function () {
    Route::get('/{id}', [ReviewController::class, 'show'])->name('review.show');
    Route::post('/{id}', [ReviewController::class, 'store'])->middleware('auth')->name('review.store');
    Route::delete('/{id}', [ReviewController::class, 'destroy'])->middleware('auth')->name('review.destroy');
    Route::get('/', [ReviewController::class, 'index'])->middleware('auth')->name('review.index');
});

Route::group(['prefix'=>'watch'],function (){
    Route::get('/{course}', [WatchController::class, 'index'])->middleware('auth')->name('watch');
});

Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback']);
Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->middleware('auth')->name('pay');

require __DIR__ . '/auth.php';
