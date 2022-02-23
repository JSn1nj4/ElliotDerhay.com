<?php

namespace App\Models;

use App\DataTransferObjects\TwitterUserDTO;
use App\Definitions\CreateMode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterUser extends Model
{
	use HasFactory;

	protected $fillable = [
		'id',
		'name',
		'screen_name',
		'profile_image_url_https',
	];

	public static function fromDTO(TwitterUserDTO $dto, CreateMode $mode = CreateMode::FirstOrCreate): self
	{
		return self::{$mode->value}(['id' => $dto->id], [
			'name' => $dto->name,
			'screen_name' => $dto->screen_name,
			'profile_image_url_https' => $dto->profile_image_url_https,
		]);
	}

	public function getProfileUrlAttribute(): string
	{
		return "https://twitter.com/{$this->screen_name}";
	}

	public function tweets()
	{
		return $this->hasMany(Tweet::class);
	}
}
