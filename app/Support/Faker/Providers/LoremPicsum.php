<?php

namespace App\Support\Faker\Providers;

use App\DataTransferObjects\QueryParam;
use Faker\Provider\Base;
use Illuminate\Support\Number;

class LoremPicsum extends Base
{
	public const BASE_URL = 'https://picsum.photos';
	public const FORMAT_JPG = 'jpg';
	public const FORMAT_JPEG = 'jpeg';
	public const FORMAT_PNG = 'png';
	public const FORMAT_WEBP = 'webp';

	public static function imageUrl(
		$width = 640,
		$height = 480,
		$gray = false,
		$format = 'png',
		int|null $blur = null,
	)
	{
		// Validate image format
		$imageFormats = static::getFormats();

		if (!in_array(strtolower($format), $imageFormats, true)) {
			throw new \InvalidArgumentException(sprintf(
				'Invalid image format "%s". Allowable formats are: %s',
				$format,
				implode(', ', $imageFormats),
			));
		}

		$size = strtr(':w/:h', [
			':w' => $width,
			':h' => $height,
		]);

		$params = [];

		if ($gray === true) {
			$params[] = new QueryParam('grayscale', allow_empty: true);
		}

		if ($blur !== null) {
			$blur = Number::clamp($blur, 1, 10);

			$params[] = match (true) {
				$blur > 1 => new QueryParam('blur', $blur),
				default => new QueryParam('blur', allow_empty: true),
			};
		}

		return strtr(":url/:w/:h.:format:params", [
			':url' => self::BASE_URL,
			':size' => $size,
			':format' => $format,
			':params' => count($params) > 0 ? '?' . build_query_string($params) : ''
		]);
	}

	public static function getFormats(): array
	{
		return array_keys(static::getFormatConstants());
	}

	public static function getFormatConstants(): array
	{
		return [
			static::FORMAT_JPG => constant('IMAGETYPE_JPEG'),
			static::FORMAT_JPEG => constant('IMAGETYPE_JPEG'),
			static::FORMAT_PNG => constant('IMAGETYPE_PNG'),
			static::FORMAT_WEBP => constant('IMAGETYPE_WEBP'),
		];
	}
}
