<?php

namespace App\Services;

use App\Traits\MakesSelf;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ImageService
{
	use MakesSelf;

	public static function asset(string $filename): string
	{
		return self::make()->url($filename, 's3-assets');
	}

	private static function ensureCached(string $path, string $disk): void
	{
		if (Storage::disk('public-cache')->exists($path)) return;

		Storage::disk('public-cache')
			->writeStream($path, Storage::disk($disk)
				->readStream($path));
	}

	public function url(string $path, string $disk): string
	{
		return Cache::rememberForever($path, function () use ($path, $disk) {
			if (app()->environment('production')) return Storage::disk($disk)->url($path);

			self::ensureCached($path, $disk);

			return Storage::disk('public-cache')->url($path);
		});
	}
}
