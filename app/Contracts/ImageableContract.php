<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface ImageableContract
{
	public function image(): Attribute;

	public function images(): MorphToMany;
}
