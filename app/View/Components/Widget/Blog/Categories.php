<?php

namespace App\View\Components\Widget\Blog;

use App\Enums\DisplayMode;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Categories extends Component
{
	public Collection|null $categories;
	public DisplayMode $displayMode;

	/**
	 * Create a new component instance.
	 * @param string|null $displayMode
	 * @param \Illuminate\Database\Eloquent\Collection|null $categories
	 */
    public function __construct(
		string|null $displayMode = null,
		Collection|null $categories = null,
	)
	{
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
		if(!config('blog.feature.categories_widget')) return false;

		$this->categories ??= Category::withExists('posts')->get();

		if($this->categories->count() === 0) return false;

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
