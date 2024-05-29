<?php

namespace App\Models;

use App\Traits\CourseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, CourseTrait;

    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'duration',
        'category_id',
        'instructor_id',
        'rating_id',
        'objective',
        'requirement',
        'avg_rating'
    ];

    protected function casts(): array
    {
        return [
            'objective' => 'array',
            'requirement' => 'array',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function enrollment()
    {
        $this->hasMany(Enrollment::class);
    }
}
