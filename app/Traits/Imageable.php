<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Imageable
{
	public function image(): MorphOne
	{
		return $this->morphOne(Image::class, 'imageable')->latestOfMany();
	}

	public function images(): MorphToMany
	{
		return $this->morphToMany(Image::class, 'imageable');
	}
}
