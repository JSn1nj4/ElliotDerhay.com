<?php

namespace App\Models;

use App\DataTransferObjects\GithubUserDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GithubUser
 *
 * @property int $id
 * @property string $login
 * @property string $display_login
 * @property string $avatar_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GithubEvent[] $events
 * @property-read int|null $events_count
 * @method static \Database\Factories\GithubUserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser whereAvatarUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser whereDisplayLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
