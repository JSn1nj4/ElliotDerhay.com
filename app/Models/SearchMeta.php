<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $search_title
 * @property string $search_description
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
