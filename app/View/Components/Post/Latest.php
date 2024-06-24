<?php

namespace App\View\Components\Post;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Latest extends Component
{
	public Post|null $post;

	/**
	 * Create a new component instance.
	 */
	public function __construct() {
		$this->post = Post::latest()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View {
		return view('components.post.latest');
	}
}
