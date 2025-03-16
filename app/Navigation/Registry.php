<?php

namespace App\Navigation;

use App\DataTransferObjects\NavItemDTO;
use App\Enums\NavLocation;
use Illuminate\Support\Collection;

class Registry
{
	/**
	 * @var array<string, \Illuminate\Support\Collection<NavItemDTO>> $navigationMenuLocations
	 */
	public function __construct(
		protected array $navigationMenuLocations = [],
	) {}

	/**
	 * @param \App\Enums\NavLocation $location
	 * @return \Illuminate\Support\Collection<NavItemDTO>
	 */
	public function locationItems(NavLocation $location): Collection
	{
		return $this->navigationMenuLocations[$location->name];
	}
}
