<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

	protected $fillable = [
		'user_id',
	];

	public function user()
	{
		return $this->belongsTo(User::class)->first();
	}

	public static function track(User $user): static
	{
		return static::create([
			'user_id' => $user->id,
		]);
	}
}
