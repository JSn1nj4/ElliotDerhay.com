<?php

namespace App\View\Components\Media;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CaptionableImage extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string      $src,
		public string|null $title = null,
		public string|null $alt = null,
		public bool        $lightbox = false,
	) {}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.media.captionable-image');
	}
}
