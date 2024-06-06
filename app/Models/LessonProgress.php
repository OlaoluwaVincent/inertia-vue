<?php

namespace App\Models;

use App\Traits\lessonProgressTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonProgress extends Model
{
    use HasFactory, lessonProgressTrait;

    public function course(): BelongsTo
    {
       return $this->belongsTo(Course::class);
    }public function lesson(): BelongsTo
    {
       return $this->belongsTo(Lesson::class);
    }public function user(): BelongsTo
    {
       return $this->belongsTo(User::class);
    }
}
