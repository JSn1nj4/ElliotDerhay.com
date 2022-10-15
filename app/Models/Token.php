<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Token
 *
 * @property int $id
 * @property string $service
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Token expired()
 * @method static \Database\Factories\TokenFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Token query()
 * @method static \Illuminate\Database\Eloquent\Builder|Token valid()
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereValue($value)
 * @mixin \Eloquent
 */
class Token extends Model
{
	use HasFactory;

	protected $dates = [
		'expires_at',
	];

	protected $fillable = [
		'service',
		'expires_at',
		'value',
	];

	public function scopeExpired($query)
	{
		return $query
			->whereNotNull('expires_at')
			->where('expires_at', '<=', Carbon::today()->toDateTimeString());
	}

	public function scopeValid($query)
	{
		return $query
			->whereNull('expires_at')
			->orWhere('expires_at', '>', Carbon::today()->toDateTimeString());
	}
}
