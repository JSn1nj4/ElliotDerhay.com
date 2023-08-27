<?php

namespace App\View\Components\Widget\Blog;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Tags extends Component
{
	public Collection $tags;

	/**
	 * Create a new component instance.
	 *
	 * @param string $sortBy
	 * @param \Illuminate\Database\Eloquent\Collection|null $tags
	 * @param int $limit
	 *
	 * @todo: map 'sortBy' values to "orderBy" methods
	 * @todo: get tags sorted by post count
	 */
    public function __construct(
		public string $sortBy = 'title',
		Collection|null $tags = null,
		public int $limit = 10,
	)
	{
		$this->sortBy = match($this->sortBy) {
			'count' => 'count',
			default => 'title',
		};

		$this->limit = min($this->limit, 50);
    }

	public function shouldRender(): bool
	{
		if(!config('blog.feature.tags_widget')) return false;

		$this->tags ??= Tag::whereHas('posts',
			static fn (Builder $builder) => $builder->published()
		)
			->limit($this->limit)
			->get();

		if($this->tags->count() === 0) return false;

		return true;
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
