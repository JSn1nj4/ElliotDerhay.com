<?php

namespace App\View\Creators;

use App\DataTransferObjects\NavItemDTO;
use Illuminate\View\View;

class PublicNavigationCreator
{
	/**
	 * @var \App\DataTransferObjects\NavItemDTO[] $navItems
	 */
	protected array $navItems = [];

	public function __construct()
	{
		$this->navItems[] = new NavItemDTO(
			'home',
			'Home',
			'fas fa-home',
		);

		if (config()->boolean('app.enable-blog')) $this->navItems[] = new NavItemDTO(
			'blog',
			'Blog',
		);

		if (config()->boolean('app.enable-projects')) $this->navItems[] = new NavItemDTO(
			'portfolio',
			'Projects'
		);
	}

	public function create(View $view): void
	{
		$view->with('navItems', $this->navItems);
	}
}
