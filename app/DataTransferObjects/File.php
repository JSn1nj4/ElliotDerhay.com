<?php

namespace App\DataTransferObjects;

class File
{
	public function __construct(
		public readonly string $name,
		public readonly string $file_name,
		public readonly string $mime_type,
		public readonly string $path,
		public readonly string $disk,
		public readonly string $hash,
		public readonly null|string $collection = null,
	) {}

	public function toArray(): array
	{
		return [
			'name' => $this->name,
			'file_name' => $this->file_name,
			'mime_type' => $this->mime_type,
			'path' => $this->path,
			'disk' => $this->disk,
			'file_hash' => $this->hash,
			'collection' => $this->collection,
		];
	}
}
