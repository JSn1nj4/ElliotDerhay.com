<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $page_title
 * @property string $meta_description
 */
class SearchDisplayMeta extends Model
{
	protected $table = 'search_displayables';

	public function searchDisplayable(): MorphTo
	{
		return $this->morphTo();
	}
}
