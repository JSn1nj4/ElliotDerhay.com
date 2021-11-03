<?php

namespace App\View\Components;

use App\Models\GithubEvent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class GithubEventsFeed extends Component
{
	public int $count;

	public string $loaderSize;

	public Collection $events;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(int $count = 7, string $loaderSize = '40px')
	{
		$this->count = $count;
		$this->loaderSize = $loaderSize;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		$this->events =	GithubEvent::with('user')
			->latest('date')
			->take($this->count)
			->get();

		return view('components.github-events-feed');
	}
}
