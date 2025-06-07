<?php

namespace App\DataTransferObjects;

class Result
{
	public function __construct(
		public bool  $success,
		public array $data = [],
		public array $errors = [],
	) {}

	public function failed(): bool
	{
		return $this->success === false;
	}

	public function hasErrors(): bool
	{
		return count($this->errors) > 0;
	}
}
