<?php

namespace App\View\Components\Post;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public Post            $post,
		public string          $size = 'sm',
		public string|null     $margin = null,
		public string|null     $padding = null,
		public readonly bool   $livewire = false,
		public readonly string $extraClasses = '',
	) {}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View
	{
		return view('components.post.card');
	}
}
