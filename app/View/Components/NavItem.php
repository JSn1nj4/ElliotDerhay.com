<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class NavItem extends Component
{
	public string $href = '';

	public bool $isActive = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
		public string $name,
		public ?string $icon = null,
		public ?string $scrollTo = null,
	)
    {
		$this->href = route($name, absolute: false) . ($scrollTo ? "#{$scrollTo}" : "");

        $this->isActive = (Route::currentRouteName() === $name);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-item');
    }
}