<?php

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
