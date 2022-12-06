<?php

namespace App\Models;

use App\Traits\HasDisplayDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
}
