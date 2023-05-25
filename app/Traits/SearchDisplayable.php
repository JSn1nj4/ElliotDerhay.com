<?php

namespace App\Traits;

use App\Models\SearchDisplayMeta;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait SearchDisplayable
{
	public function searchDisplayMeta(): MorphOne
	{
		return $this->morphOne(SearchDisplayMeta::class, 'search_displayable');
	}
}
