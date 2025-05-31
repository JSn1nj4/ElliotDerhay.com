<?php

use App\DataTransferObjects\QueryParam;
use App\DataTransferObjects\TtlDTO;
use App\Services\ImageService;

/**
 * Return static asset URL based on filename
 *
 * Uses ImageService::asset() under the hood.
 *
 * @param string $filename
 * @return string
 */
function asset_url(string $filename): string
{
	return ImageService::asset($filename);
}

/**
 * Allows building query strings that have empty parameters
 * @param \App\DataTransferObjects\QueryParam[] $parts
 * @return string
 */
function build_query_string(array $parts): string
{
	$params = collect($parts)
		->reduce(static function ($final, $part) {
			$final[$part->field] = $part->value;

			return $final;
		}, []);

	return collect($parts)
		->filter(static fn (QueryParam $item) => $item->allow_empty)
		->reduce(static function (string $final, QueryParam $item) {
			$needle = http_build_query([$item->field => $item->value]);

			return str_replace($needle, $item->field, $final);
		}, http_build_query($params));
}

/**
 * Get url for \App\Models\Image model
 *
 * Uses ImageService::url() under the hood.
 *
 * @param string $path
 * @param string $disk
 * @return string
 */
function image_url(string $path, string $disk): string
{
	return ImageService::make()->url($path, $disk);
}

/**
 * Resolve navigation item collection for specified menu
 *
 * @param \App\Enums\NavLocation $location
 * @return \Illuminate\Support\Collection<\App\DataTransferObjects\NavItemDTO>
 */
function nav(\App\Enums\NavLocation $location): \Illuminate\Support\Collection
{
	return app(\App\Navigation\Registry::class)->locationItems($location);
}

/**
 * Creates a new TtlDTO that's effectively "empty" (set to 0 at first).
 *
 * Setting the value from there can be done with a few methods and then returned for use.
 * @return TtlDTO
 */
function ttl(): TtlDTO
{
	return new TtlDTO(0);
}
