<?php

namespace App\DataTransferObjects;

/**
 * A simple token string representation
 */
readonly class TokenDTO
{
	public function __construct(public string $value)
	{
	}

	public function __toString(): string
	{
		return $this->value;
	}
}
