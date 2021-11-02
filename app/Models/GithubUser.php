<?php

namespace App\Models;

use App\DataTransferObjects\GithubUserDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GithubUser extends Model
{
	use HasFactory;

	protected $fillable = [
		'id',
		'login',
		'display_login',
		'avatar_url',
	];

	public static function fromDTO(GithubUserDTO $dto): self
	{
		return self::firstOrCreate(['id' => $dto->id], [
			'login' => $dto->login,
			'display_login' => $dto->display_login,
			'avatar_url' => $dto->avatar_url,
		]);
	}

	public function events()
	{
		return $this->hasMany(GithubEvent::class);
	}
}
