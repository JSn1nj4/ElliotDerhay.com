<?php

namespace App\Models;

use App\Traits\HasDisplayDates;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Login
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static Builder|Login newModelQuery()
 * @method static Builder|Login newQuery()
 * @method static Builder|Login query()
 * @method static Builder|Login whereCreatedAt($value)
 * @method static Builder|Login whereId($value)
 * @method static Builder|Login whereUpdatedAt($value)
 * @method static Builder|Login whereUserId($value)
 * @mixin \Eloquent
 * @method static Builder|Login mostRecent()
 */
class Login extends Model
{
    use HasDisplayDates,
		HasFactory;

	protected $fillable = [
		'user_id',
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function scopeMostRecent(Builder $query): null|Builder|Model
	{
		return $query->latest()->first();
	}
}
