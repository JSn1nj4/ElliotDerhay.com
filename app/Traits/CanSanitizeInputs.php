<?php

namespace App\Traits;

trait CanSanitizeInputs
{
	protected function sanitize(string $input): string
	{
		return str($input)
			->stripTags()
			->remove([
				"{", "}", "[", "]", '<', '>',
				"`", "~", "!", "@", "#", '$',
				'%', '^', '*', '+', '=', '/',
				'\\', "\r", "\n"
			])
			->trim()
			->toString();
	}
}
