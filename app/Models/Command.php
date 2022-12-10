<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Command
 *
 * @property int $id
 * @property string $signature
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CommandEvent[] $events
 * @property-read int|null $events_count
 * @method static \Illuminate\Database\Eloquent\Builder|Command newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Command newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Command query()
 * @mixin \Eloquent
 */
class Command extends Model
{
	protected $fillable = [
		'description',
		'signature',
	];

	public function events(): HasMany
	{
		return $this->hasMany(CommandEvent::class);
	}

	public function lastRun(): HasOne
	{
		return $this->hasOne(CommandEvent::class)->latestOfMany();
	}
}
