<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
		return $query->where('expires_at', '<=', Carbon::today()->toDateTimeString());
	}

	public function scopeValid($query)
	{
		return $query->where('expires_at', '>', Carbon::today()->toDateTimeString());
	}
}
