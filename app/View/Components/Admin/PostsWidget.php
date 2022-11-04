<?php

namespace App\View\Components\Admin;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class PostsWidget extends Component
{
	public Collection $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->posts = Post::latest()
			->limit(3)
			->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.posts-widget');
    }
}
