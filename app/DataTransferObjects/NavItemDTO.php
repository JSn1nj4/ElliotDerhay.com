<?php

namespace App\DataTransferObjects;

use Filament\Navigation\NavigationItem;

readonly class NavItemDTO
{
	public function __construct(
		public string      $route,
		public string      $label,
		public string|null $icon = null,
	) {}

	public function navigationItem(): NavigationItem
	{
		return NavigationItem::make($this->label)
			->url(route($this->route))
			->icon($this->icon);
	}
}
