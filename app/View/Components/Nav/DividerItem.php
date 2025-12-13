<?php

namespace App\View\Components\Nav;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DividerItem extends Component
{
	public string $classes = 'border-l-2 border-solid border-bright-turquoise-500 dark:border-bright-turquoise-800';

	public function __construct() {}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.nav.divider-item');
	}
}
