<?php

namespace App\View\Components\Widget\Blog;

use App\Features\BlogTagsWidget;
use App\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Laravel\Pennant\Feature;

class Tags extends Component
{
	public Collection|null $tags;

	/**
	 * Create a new component instance.
	 *
	 * @param string $sortBy
	 * @param array|null $tags
	 * @param int $limit
	 *
	 * @todo: map 'sortBy' values to "orderBy" methods
	 * @todo: get tags sorted by post count
	 */
	public function __construct(
		public string $sortBy = 'title',
		// `array` instead of `Collection` to prevent Laravel from
		// injecting an empty Collection
		array|null    $tags = null,
		public int    $limit = 10,
	)
	{
		if ($tags !== null) $this->tags = collect($tags);

		$this->sortBy = match ($this->sortBy) {
			'count' => 'count',
			default => 'title',
		};

		$this->limit = min($this->limit, 50);
	}

	public function shouldRender(): bool
	{
		if (Feature::inactive(BlogTagsWidget::class)) return false;

		$this->tags ??= Tag::withExists('posts')
			->limit($this->limit)
			->get();

		if ($this->tags->count() === 0) return false;

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
