<?php

namespace App\DataTransferObjects;

final readonly class FileLocation
{
	public function __construct(
		public string $disk,
		public string $path,
	) {}

	public function matches(self $other): bool
	{
		return $this->disk === $other->disk
			&& $this->path === $other->path;
	}
}
