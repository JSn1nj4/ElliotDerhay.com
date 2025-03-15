<?php

namespace App\View\Components\Github;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventIcon extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string $icon,
	) {}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.github.event-icon');
	}
}
