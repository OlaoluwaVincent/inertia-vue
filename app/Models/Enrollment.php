<?php

namespace App\Models;

use App\Traits\EnrollmentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory, EnrollmentTrait;

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function course()
    {
        $this->belongsTo(Course::class);
    }
}
