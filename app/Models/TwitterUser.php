<?php

namespace App\Models;

use App\DataTransferObjects\TwitterUserDTO;
use App\Enums\CreateMode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\TwitterUser
 *
 * @property int $id
 * @property string $name
 * @property string $screen_name
 * @property string $profile_image_url_https
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $profile_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tweet[] $tweets
 * @property-read int|null $tweets_count
 * @method static \Database\Factories\TwitterUserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser whereProfileImageUrlHttps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser whereScreenName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

	public function tweets(): HasMany
	{
		return $this->hasMany(Tweet::class);
	}
}
