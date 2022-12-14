<?php

namespace App\Models;

use App\Enums\PerPage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CommandEvent|null $lastRun
 * @method static \Illuminate\Database\Eloquent\Builder|Command whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Command whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Command whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Command whereSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Command whereUpdatedAt($value)
 */
class Command extends Model
{
	protected $fillable = [
		'description',
		'signature',
	];

	public static function booted(): void
	{
		static::deleted(function (Command $command) {
			CommandEvent::whereCommandId($command->id)->delete();
		});
	}

	public function events(): HasMany
	{
		return $this->hasMany(CommandEvent::class);
	}

	public static function index(Request $request): AbstractPaginator
	{
		return self::latest()
			->paginate(PerPage::filter(
				optional($request)->per_page
			))
			->withQueryString();
	}

	public function lastRun(): HasOne
	{
		return $this->hasOne(CommandEvent::class)->latestOfMany();
	}
}
