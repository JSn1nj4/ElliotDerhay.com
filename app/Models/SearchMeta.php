<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\SearchMeta
 *
 * @property string $search_title
 * @property string $search_description
 * @property int $id
 * @property int $search_displayable_id
 * @property string $search_displayable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $searchDisplayable
 * @method static \Illuminate\Database\Eloquent\Builder|SearchMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchMeta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchMeta whereSearchDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchMeta whereSearchDisplayableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchMeta whereSearchDisplayableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchMeta whereSearchTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchMeta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SearchMeta extends Model
{
	protected $table = 'search_displayables';

	protected $fillable = [
		'search_title',
		'search_description',
	];

	public function searchDisplayable(): MorphTo
	{
		return $this->morphTo();
	}
}
