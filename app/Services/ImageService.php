<?php

namespace App\Services;

use App\Models\Image;
use App\Traits\MakesSelf;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ImageService
{
	use MakesSelf;

	public function url(Image $image): string
	{
		return Cache::rememberForever($image->path, function () use ($image) {
			if (!Storage::disk('public-cache')->exists($image->path)) {
				Storage::disk('public-cache')
					->writeStream($image->path, Storage::disk($image->disk)
						->readStream($image->path));
			}

			return Storage::disk('public-cache')->url($image->path);
		});
	}
}
