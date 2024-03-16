<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Lightbox extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public readonly int    $speed = 200,
		public readonly string $timing = 'linear',
		public readonly bool   $transition = true,
	)
	{
		//
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View
	{
		return view('components.lightbox');
	}
}
