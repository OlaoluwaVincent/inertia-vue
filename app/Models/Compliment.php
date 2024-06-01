<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $comment
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ComplimentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Compliment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compliment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compliment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Compliment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compliment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compliment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compliment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compliment whereUserId($value)
 * @mixin \Eloquent
 */
class Compliment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
