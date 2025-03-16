<?php

namespace App\View\Components\Widget\Blog;

use App\Features\BlogGithubFeedWidget;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Laravel\Pennant\Feature;

class GithubFeed extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $displayType = 'default')
	{
		//
	}

	public function shouldRender(): bool
	{
		return Feature::allAreActive([
			\App\Features\GithubFeed::class,
			BlogGithubFeedWidget::class,
		]);
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View
	{
		return view('components.widget.blog.github-feed');
	}
}
