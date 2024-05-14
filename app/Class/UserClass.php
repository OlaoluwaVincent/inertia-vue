<?php

namespace App\Class;

use Illuminate\Support\Facades\Auth;

class UserClass extends Auth
{
    public $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function isAdmin()
    {
        // dd($this->user->id);
        return $this->user->role === 'ADMIN';
    }

    public function owns($model)
    {
        return $this->user->id === $model->user_id;
    }
}
