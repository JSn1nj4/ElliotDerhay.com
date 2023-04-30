<?php

namespace App\View\Renderers\Markdown\Traits;

trait Resumeable
{
	public static function __set_state(array $state_array): static
	{
		$object = new static();

		foreach ($state_array as $prop => $state) {
			if (!property_exists($object, $prop)) continue;

			$object->{$prop} = $state;
		}

		return $object;
	}
}
