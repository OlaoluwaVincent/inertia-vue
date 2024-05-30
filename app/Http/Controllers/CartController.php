<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function __invoke(Request $request)
    {
        $enrolled_courses = Enrollment::where('user_id', $request->user()->id)->select('course_id')->get();

        return Inertia::render('Cart', ['enrolled_courses' => $enrolled_courses]);
    }
}
