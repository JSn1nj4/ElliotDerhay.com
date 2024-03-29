<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Row extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
		public ?string $id = null,
		public string $class = '',
		public ?string $flexClass = 'md:flex',
		public ?string $overlayClasses = null,
		public ?string $backgroundImage = null,
		public readonly bool $contained = true
	) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.row');
    }
}
