<?php

namespace App\Traits;

trait MakesSelf
{
	public static function make(mixed ...$args): static
	{
		return new static(...$args);
	}
}
