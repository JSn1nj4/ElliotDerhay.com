<?php

namespace App\Providers;

use App\DataTransferObjects\NavItemDTO;
use Illuminate\Support\ServiceProvider;

class NavigationProvider extends ServiceProvider
{
	/**
	 * @var \App\DataTransferObjects\NavItemDTO[] $navItems
	 */
	public array $navItems = [];

	/**
	 * Register services.
	 */
	public function register(): void
	{
		$this->navItems = [
			new NavItemDTO('home', 'Home', 'fas fa-home'),
		];

		if (config('app.enable-blog')) {
			$this->navItems[] = new NavItemDTO('blog', 'Blog', 'heroicon-o-newspaper');
		}

		if (config('app.enable-projects')) {
			$this->navItems[] = new NavItemDTO('portfolio', 'Projects', 'm-code-bracket');
		}
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		//
	}
}
