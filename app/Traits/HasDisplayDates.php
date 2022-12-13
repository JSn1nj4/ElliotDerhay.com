<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasDisplayDates
{
	public function longDateAtTime(): Attribute
	{
		return Attribute::get(fn () => $this->created_at->toDayDateTimeString());
	}

	public function dateAtTime(): Attribute
	{
		return Attribute::get(fn () => $this->created_at->format('M d Y \a\t H:i'));
	}

	public function shortDate(): Attribute
	{
		return Attribute::get(fn () => $this->created_at->format('d M Y'));
	}
}
