<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{

    public function show(Request $request)
    {
        return Inertia::render('Dashboard', [
            'status' => session('status'),
        ]);
    }
}
