<?php

namespace App\View\Components\Nav;

use Illuminate\View\Component;

abstract class ItemBase extends Component
{
	public string $baseClasses = 'justify-items-start place-items-center gap-2 text-left text-bright-turquoise-800 dark:text-bright-turquoise-500 hover:text-neutral-700 dark:hover:text-white transition-colors duration-300';

	public function __construct(
		public string|null $text = null,
	) {}
}
