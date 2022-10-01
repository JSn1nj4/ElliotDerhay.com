<?php

namespace App\View\Components\Card;

use Illuminate\View\Component;

class Thumbnail extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
		public string $href = '',
		public string $src = '',
		public string $target = '_self',
	)
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card.thumbnail');
    }
}
