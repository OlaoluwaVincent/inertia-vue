<?php

namespace App\Models;

use App\Enums\LessonProgressEnum;
use App\Traits\lessonProgressTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $lesson_id
 * @property float $duration
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\Lesson $lesson
 * @property-read \App\Models\Course $loadCourse
 * @property-read \App\Models\Lesson $loadLesson
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress query()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonProgress whereUserId($value)
 * @mixin \Eloquent
 */
class LessonProgress extends Model
{
    use HasFactory, lessonProgressTrait;

    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_id',
        'status',
        'duration',
        'status',
    ];

    protected $casts = [
        'status' => LessonProgressEnum::class,
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
