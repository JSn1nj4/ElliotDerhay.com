<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Login extends Model
{
    use HasFactory;

	protected $fillable = [
		'user_id',
	];

	public function user(): User|BelongsTo|null
	{
		return $this->belongsTo(User::class)->first();
	}
}
