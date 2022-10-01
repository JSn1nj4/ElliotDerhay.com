<?php

namespace App\Models;

use App\DataTransferObjects\GithubEventDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\GithubEvent
 *
 * @property string $id
 * @property string $type
 * @property string|null $action
 * @property \Illuminate\Support\Carbon $date
 * @property int $user_id
 * @property string|null $source
 * @property string $repo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\GithubUser|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereRepo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereUserId($value)
 * @mixin \Eloquent
 */
class GithubEvent extends Model
{
	use HasFactory;

	protected $casts = [
		'id' => 'string',
	];

	protected $dates = [
		'date',
	];

	protected $fillable = [
		'id',
		'type',
		'action',
		'date',
		'user_id',
		'source',
		'repo',
	];

	public static function fromDTO(GithubEventDTO $dto): self
	{
		return self::firstOrCreate(['id' => intval($dto->id)], [
			'type' => $dto->type,
			'action' => $dto->action,
			'date' => $dto->date,
			'user_id' => GithubUser::fromDTO($dto->user)->id,
			'source' => $dto->source,
			'repo' => $dto->repo,
		]);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(GithubUser::class);
	}
}
