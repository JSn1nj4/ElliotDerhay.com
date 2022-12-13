<?php

namespace App\Actions;

class BaseAction
{
	public function __construct() {
		// ...
	}

	/**
	 * Create new instance procedurally
	 *
	 * This will allow chaining where using `new` directly not preferred.
	 *
	 * @return static
	 */
	public static function make(): static
	{
		return new static();
	}
}
