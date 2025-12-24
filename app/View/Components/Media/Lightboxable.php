<?php

namespace App\View\Components\Media;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Lightboxable extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string      $src,
		public string|null $title = null,
		public string|null $alt = null,
	) {}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.media.lightboxable');
	}
}
