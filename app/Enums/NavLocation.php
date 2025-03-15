<?php

namespace App\Enums;

use App\DataTransferObjects\NavItemDTO;
use Illuminate\Support\Collection;

enum NavLocation: string
{
	case PublicNavBar = 'public-nav-bar';
	case AdminNavBar = 'admin-nav-bar';

	public function items(): array
	{
		return collect(match ($this) {
			self::AdminNavBar,
			self::PublicNavBar => [
				new NavItemDTO('home', 'Home', 'heroicon-m-home')
			],
		})
			->when(config('app.enable-blog'), fn (Collection $collection) => $collection->push(
				new NavItemDTO('blog', 'Blog', 'heroicon-m-newspaper')
			))
			->when(config('app.enable-projects'), fn (Collection $collection) => $collection->push(
				new NavItemDTO('portfolio', 'Projects', 'heroicon-m-code-bracket')
			))
			->all();
	}
}
