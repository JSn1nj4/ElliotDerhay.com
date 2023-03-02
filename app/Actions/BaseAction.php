<?php

namespace App\Actions;

abstract class BaseAction
{
	public function __construct() {
		// ...
	}

	public function __invoke(): void
	{

	}

	/**
	 * Create new instance procedurally
	 *
	 * This will allow chaining where using `new` directly not preferred.
	 *
	 * @return static
	 */
	public static function make(...$params): static
	{
		return new static(...$params);
	}

	public static function invoke(...$params): mixed
	{
		$action = new static();

		return $action(...$params);
	}
}
