<?php

namespace App\DataTransferObjects;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final readonly class ImageDTO
{
	public function __construct(
		public string $name,
		public string $file_name,
		public string $mime_type,
		public string $path,
		public string $file_hash,
		public int $size,
		public string|null $collection,
		public string $disk = 'local',
	) {}

	public static function fromUpload(
		UploadedFile $file,
		string $collection = 'images',
		string $temp_disk = 'temp',
	): self
	{
		$temp_path = $file->store($collection, $temp_disk);

		return new self(
			name: $file->hashName(),
			file_name: $file->getClientOriginalName(),
			mime_type: $file->getClientMimeType(),
			path: $temp_path,
			file_hash: hash_file(
				algo: config('app.uploads.hash'),
				filename: Storage::disk($temp_disk)->path($temp_path),
			),
			size: $file->getSize(),
			collection: $collection,
			disk: $temp_disk,
		);
	}
}
