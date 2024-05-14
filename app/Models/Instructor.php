<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'password',
        'bio',
        'profile_picture',
        'socials',
        'followers',
        'headline',
        'professional_experience',
        'expertise',
        'languages'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
