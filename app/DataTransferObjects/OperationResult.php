<?php

namespace App\DataTransferObjects;

final readonly class OperationResult
{
	public function __construct(
		public bool $succeeded,
		public string $message,
	) {}
}
