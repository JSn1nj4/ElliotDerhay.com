<?php

namespace App\View\Components\Widget\Blog;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Tags extends Component
{
	public Collection $tags;

    /**
     * Create a new component instance.
	 *
	 * @todo: get tags sorted by post count
	 * @todo: map 'sortBy' values to "orderBy" methods
     *
     * @return void
     */
    public function __construct(
		public string $sortBy = 'title',
		public int $limit = 10,
	)
	{
		$this->sortBy = match($this->sortBy) {
			'count' => 'count',
			default => 'title',
		};

		$this->limit = min($this->limit, 50);

		$this->tags = Tag::withExists('posts')
			->limit($this->limit)
			->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widget.blog.tags');
    }
}
