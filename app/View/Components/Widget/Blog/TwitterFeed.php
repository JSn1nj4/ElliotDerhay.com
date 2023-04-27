<?php

namespace App\View\Components\Widget\Blog;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Laravel\Pennant\Feature;

class TwitterFeed extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

	public function shouldRender(): bool
	{
		return Feature::active(\App\Features\TwitterFeed::class);
	}

	/**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.widget.blog.twitter-feed');
    }
}
