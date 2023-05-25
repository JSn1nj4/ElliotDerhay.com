<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface SearchDisplayableContract
{
	public function pageTitle(): Attribute;

	public function metaDescription(): Attribute;

	public function searchDisplayMeta(): MorphOne;
}
