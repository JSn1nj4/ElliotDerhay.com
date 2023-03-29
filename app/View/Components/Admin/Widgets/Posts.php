<?php

namespace App\View\Components\Admin\Widgets;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Posts extends Component
{
	public Collection $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $count = 3)
    {
        $this->posts = Post::latest()
			->limit($count)
			->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.widgets.posts');
    }
}
