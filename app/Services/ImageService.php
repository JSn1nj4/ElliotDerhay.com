<?php

namespace App\Services;

use App\Traits\MakesSelf;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ImageService
{
	use MakesSelf;

	public function url(string $path, string $disk): string
	{
		return Cache::rememberForever($path, function () use ($path, $disk) {
			if (!Storage::disk('public-cache')->exists($path)) {
				Storage::disk('public-cache')
					->writeStream($path, Storage::disk($disk)
						->readStream($path));
			}

			return Storage::disk('public-cache')->url($path);
		});
	}
}
