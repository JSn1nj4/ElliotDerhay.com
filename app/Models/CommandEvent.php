<?php

namespace App\Models;

use App\Enums\PerPage;
use App\Traits\HasDisplayDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Carbon;

/**
 * App\Models\CommandEvent
 *
 * @property int $id
 * @property int $command_id
 * @property Command $command
 * @property bool $succeeded
 * @property string $message
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static \Database\Factories\CommandEventFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CommandEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommandEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommandEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommandEvent whereCommandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommandEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommandEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommandEvent whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommandEvent whereSucceeded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommandEvent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CommandEvent extends Model
{
    use HasDisplayDates,
		HasFactory;

	protected $fillable = [
		'command_id',
		'succeeded',
		'message',
	];

	public function command(): BelongsTo
	{
		return $this->belongsTo(Command::class);
	}

	public static function index(Request $request, ?Command $command = null): AbstractPaginator
	{
		return self::when($command, function ($query, $command): void {
				$query->whereRelation('command', 'command_id', $command->id);
			})
			->with('command')
			->latest()
			->paginate(PerPage::filter(
				optional($request)->per_page
			))
			->withQueryString();
	}
}
