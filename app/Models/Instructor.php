<?php

namespace App\Models;

use Database\Factories\InstructorFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property array|null $followers
 * @property string $headline
 * @property string $professional_experience
 * @property array|null $expertise
 * @property array|null $languages
 * @property int $user_id
 * @property-read Collection<int, Course> $courses
 * @property-read int|null $courses_count
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read User $user
 * @method static InstructorFactory factory($count = null, $state = [])
 * @method static Builder|Instructor newModelQuery()
 * @method static Builder|Instructor newQuery()
 * @method static Builder|Instructor query()
 * @method static Builder|Instructor whereCreatedAt($value)
 * @method static Builder|Instructor whereExpertise($value)
 * @method static Builder|Instructor whereFollowers($value)
 * @method static Builder|Instructor whereHeadline($value)
 * @method static Builder|Instructor whereId($value)
 * @method static Builder|Instructor whereLanguages($value)
 * @method static Builder|Instructor whereProfessionalExperience($value)
 * @method static Builder|Instructor whereUpdatedAt($value)
 * @method static Builder|Instructor whereUserId($value)
 * @property-read int|null $reviews_count
 * @mixin Eloquent
 */
class Instructor extends Model
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


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function courses():HasMany
    {
        return $this->hasMany(Course::class);
    }
}
