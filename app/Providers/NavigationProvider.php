<?php

namespace App\Providers;

use App\DataTransferObjects\NavItemDTO;
use App\Enums\NavLocation;
use App\Navigation\Registry;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class NavigationProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->singleton(Registry::class, fn () => new Registry([
			NavLocation::AdminNavBar->name => collect([
				new NavItemDTO('home', 'Home', 'heroicon-m-home'),
			])->when(config('app.enable-blog'), fn (Collection $collection) => $collection->push(
				new NavItemDTO('blog', 'Blog', 'heroicon-m-newspaper')
			))->when(config('app.enable-projects'), fn (Collection $collection) => $collection->push(
				new NavItemDTO('portfolio', 'Projects', 'heroicon-m-code-bracket')
			)),

			NavLocation::PublicNavBar->name => collect([
				new NavItemDTO('home', 'Home', 'heroicon-m-home'),
			])->when(config('app.enable-blog'), fn (Collection $collection) => $collection->push(
				new NavItemDTO('blog', 'Blog', 'heroicon-m-newspaper')
			))->when(config('app.enable-projects'), fn (Collection $collection) => $collection->push(
				new NavItemDTO('portfolio', 'Projects', 'heroicon-m-code-bracket')
			))
		]));
	}

	public function boot(): void
	{
		//
	}
}
