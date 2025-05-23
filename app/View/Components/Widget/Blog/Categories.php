<?php

namespace App\View\Components\Widget\Blog;

use App\Enums\DisplayMode;
use App\Features\BlogCategoriesWidget;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Laravel\Pennant\Feature;

class Categories extends Component
{
	public Collection|null $categories;

	public DisplayMode $displayMode;

	/**
	 * Create a new component instance.
	 * @param string|null $displayMode
	 * @param array|null $categories
	 */
	public function __construct(
		string|null $displayMode = null,
		// `array` instead of `Collection` to prevent Laravel from
		// injecting an empty Collection
		array|null  $categories = null,
	)
	{
		if ($categories !== null) $this->categories = collect($categories);

		try {
			$this->displayMode = DisplayMode::from($displayMode);
		} catch (\Throwable $throwable) {
			$this->displayMode = DisplayMode::List;
		}
	}

	/**
	 * @return bool
	 */
	public function shouldRender(): bool
	{
		if (Feature::inactive(BlogCategoriesWidget::class)) return false;

		$this->categories ??= Category::withExists('posts')->get();

		if ($this->categories->count() === 0) return false;

		return true;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		return view('components.widget.blog.categories');
	}
}
