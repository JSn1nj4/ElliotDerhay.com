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
		public string $route,
		public ?string $icon = null,
		public ?string $scrollTo = null,
		public readonly bool $inline = false,
	)
    {
		$this->href = route($route, absolute: false) . ($scrollTo ? "#{$scrollTo}" : "");

        $this->isActive = (Route::currentRouteName() === $route);
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
