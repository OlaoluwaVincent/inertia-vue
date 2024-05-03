<?php

namespace App\Http\Controllers\ModelControllers;

use App\Models\Compliment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class ComplimentsController extends Controller
{
    public function showCompliments()
    {
        $compliments = Compliment::all();
        foreach ($compliments as $compliment) {
            $user = User::find($compliment->user_id);
            // Assuming you want to attach the user to the compliment object
            $compliment->user = [
                'name' => $user->fullname,
                'image' => $user->profile_picture,
            ];
        }
        return $compliments;
    }
}
