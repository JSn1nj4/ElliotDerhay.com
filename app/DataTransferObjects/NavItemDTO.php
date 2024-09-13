<?php

namespace App\DataTransferObjects;

readonly class NavItemDTO
{
	public function __construct(
		public string      $route,
		public string      $label,
		public string|null $icon = null,
	) {}
}
