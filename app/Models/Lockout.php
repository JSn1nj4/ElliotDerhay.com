<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Lockout
 *
 * @method static \Database\Factories\LockoutFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lockout query()
 * @mixin \Eloquent
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
