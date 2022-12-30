<?php

namespace App\Services;

use App\Contracts\UploadServiceContract;
use App\DataTransferObjects\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService implements UploadServiceContract
{
	public function image(UploadedFile $file): File
	{
		$name = $file->hashName();

		$upload = Storage::put("{$name}", $file);

		return new File(
			name: "{$name}",
			file_name: $file->getClientOriginalName(),
			mime_type: $file->getClientMimeType(),
			path: $upload->path(),
			disk: config('app.uploads.disk'),
			hash: hash_file(
				config('app.uploads.hash'),
				storage_path("images/{$name}"),
			),
			collection: 'images',
		);
	}
}
