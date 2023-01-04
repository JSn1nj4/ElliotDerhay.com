<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Imageable
{
	public function image(): Attribute
	{
		return Attribute::get(fn () => $this->images()->first());
	}

	public function images(): MorphToMany
	{
		return $this->morphToMany(Image::class, 'imageable');
	}
}
