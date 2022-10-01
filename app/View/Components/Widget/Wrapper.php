<?php

namespace App\View\Components\Widget;

use Illuminate\View\Component;

class Wrapper extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
		public string $title,
	)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widget.wrapper');
    }
}
