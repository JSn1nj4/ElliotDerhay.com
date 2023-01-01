<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface ImageableContract
{
	public function image(): MorphOne;
	public function images(): MorphToMany;
}
