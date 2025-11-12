<?php

namespace App\View\Components\Nav;

use Closure;
use Illuminate\Contracts\View\View;

class ButtonItem extends ItemBase
{
	public function __construct(
		public string      $class,
		string|null        $text = null,
		public string|null $buttonText = null,
		public string|null $onclick = null,
	)
	{
		parent::__construct($text);
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.nav.button-item');
	}
}
