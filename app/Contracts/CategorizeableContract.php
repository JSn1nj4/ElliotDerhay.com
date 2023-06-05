<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface CategorizeableContract
{
	public function categories(): MorphToMany;
}
