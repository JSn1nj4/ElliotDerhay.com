<?php

namespace App\Traits;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Categorizeable
{
	public function categories(): MorphToMany
	{
		return $this->morphToMany(Category::class, 'categorizeable');
	}
}
