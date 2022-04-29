<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Nav extends Component
{
	public array $menuItems;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->menuItems = [
			(object) [
				'name' => 'home',
				'label' => 'Home',
				'icon' => 'fas fa-home',
			],
		];

		$optionalMenuItems = [
			(object) [
				'name' => 'blog',
				'label' => 'Blog',
			],
		];

		foreach($optionalMenuItems as $item) {
			if(config("app.enable-" . $item->name)) $this->menuItems[] = $item;
		}
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav');
    }
}
