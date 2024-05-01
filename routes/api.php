<?php

use App\Http\Controllers\QuickRequestController;
use Illuminate\Support\Facades\Route;



Route::get('/api/popular', [QuickRequestController::class, 'show']);
