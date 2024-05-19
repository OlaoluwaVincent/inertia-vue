<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Instructor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'followers',
        'headline',
        'professional_experience',
        'expertise',
        'languages',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'followers' => 'array',
            'languages' => 'array',
            'expertise' => 'array'
        ];
    }


    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
