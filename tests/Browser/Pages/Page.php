<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Page as BasePage;
use Tests\Browser\Components\Footer;
use Tests\Browser\Components\Header;

abstract class Page extends BasePage
{
	protected ?object $components;

	public function __construct()
	{
		$this->components = (object)[];

		$this->registerComponents([
			'header' => new Header,
			'footer' => new Footer,
		]);
	}

	public function __get($property): mixed
	{
		return $this->$property;
	}

	/**
	 * Get the global element shortcuts for the site.
	 *
	 * @return array
	 */
	public static function siteElements()
	{
		return [
			'@main' => 'main',
		];
	}

	/**
	 * Get the global components for the site.
	 */
	protected function registerComponents(array $components): void
	{
		$this->components = (object) array_merge(
			(array) $this->components,
			$components
		);
	}
}
