<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
