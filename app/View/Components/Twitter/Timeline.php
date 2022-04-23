<?php

namespace App\View\Components\Twitter;

use App\Models\Tweet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Timeline extends Component
{
	public int $count;

	public string $loaderSize;

	public Collection $tweets;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(int $count = 5, string $loaderSize = '40px')
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
		$this->tweets = Tweet::with('user')
			->latest('date')
			->take($this->count)
			->get();

		return view('components.twitter.timeline');
	}
}
