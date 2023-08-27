<?php

namespace App\Actions;

abstract class BaseAction
{
	public function __construct() {
		// ...
	}

	/**
	 * Create new instance procedurally
	 *
	 * This will allow chaining where using `new` directly not preferred.
	 *
	 * @param mixed ...$params
	 * @return static
	 */
	public static function make(...$params): static
	{
		return new static(...$params);
	}
}
