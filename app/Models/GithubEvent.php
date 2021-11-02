<?php

namespace App\Models;

use App\DataTransferObjects\GithubEventDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

	public function user()
	{
		return $this->belongsTo(GithubUser::class);
	}
}
