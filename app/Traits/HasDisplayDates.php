<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasDisplayDates
{
	public function shortDate(): Attribute
	{
		return Attribute::get(fn () => $this->created_at->format('d M Y'));
	}
}
