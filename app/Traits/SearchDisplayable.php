<?php

namespace App\Traits;

use App\Models\SearchMeta;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait SearchDisplayable
{
	public function searchMeta(): MorphOne
	{
		return $this->morphOne(SearchMeta::class, 'search_displayable');
	}
}
