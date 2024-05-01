<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class QuickRequestController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $courses = Course::with('instructor')->get();
        $result = [];

        foreach ($courses as $item) {
            // Create a new object with required keys
            $newItem = [
                'title' => $item['title'],
                'description' => $item['description'],
                'image' => $item['image'],
                'price' => $item['price'],
                'duration' => $item['duration'],
                'instructor' => [
                    'name' => $item['instructor']['name']
                ]
            ];

            // Push the modified object into the result array
            $result[] = $newItem;
        }
        $result = array_slice($result, 0, 4);
        return $result;
    }
}
