<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $email
 * @property int $succeeded
 * @property string|null $info
 * @property string $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity failed()
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity old(Carbon|null $maxAge = null)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity succeeded()
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity whereSucceeded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginActivity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LoginActivity extends Model
{
	use HasFactory;

	protected $table = 'login_activity';

	protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];

	protected $fillable = [
		'email',
		'succeeded',
		'info',
		'ip_address',
	];

	public function scopeFailed(Builder $query): void
	{
		$query->where('succeeded', false);
	}

	public function scopeSucceeded(Builder $query): void
	{
		$query->where('succeeded', true);
	}

	public function scopeOld(Builder $query, Carbon|null $maxAge = null): void
	{
		$maxAge ??= now()->startOfDay()->subDays(config()->integer('auth.activity.days_to_retain'));

		$query->whereDate('created_at', '<=', $maxAge);
	}
}
