<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Lockout
 *
 * @property int $id
 * @property string $ip_address
 * @property string $url
 * @property string $user_agent
 * @property string $content_type
 * @property string $credential
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static \Database\Factories\LockoutFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout query()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout whereContentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout whereCredential($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout whereUserAgent($value)
 */
class Lockout extends Model
{
    use HasFactory;

	public $fillable = [
		'ip_address',
		'url',
		'user_agent',
		'content_type',
		'credential',
	];
}
