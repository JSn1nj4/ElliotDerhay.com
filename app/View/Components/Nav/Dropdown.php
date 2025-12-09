<?php

namespace App\View\Components\Nav;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * @property bool $mobileCondense only collapse into a toggleable dropdown on mobile
 */
class Dropdown extends Component
{
	public string $toggleClasses;
	public string $wrapperClasses;
	public string $containerClasses;

	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public bool $mobileCondense = false,
	)
	{
		$this->toggleClasses = implode(" ", array_keys(array_filter([
			'peer' => true,
			'md:hidden' => $this->mobileCondense,
		])));

		$this->wrapperClasses = implode(" ", array_keys(array_filter([
			'hidden' => true,
			'md:block' => $this->mobileCondense,
			'peer-has-checked:block' => true,
			'absolute' => true,
			'md:relative' => $this->mobileCondense,
			'-right-3' => true,
			'md:right-0' => $this->mobileCondense,
			'top-12' => true,
			'md:top-[3.50rem]' => !$this->mobileCondense,
			'md:top-0' => $this->mobileCondense,
			'-z-50' => true,
			'md:z-0' => $this->mobileCondense,
			'opacity-0' => true,
			'md:opacity-100' => $this->mobileCondense,
			'border-2' => true,
			'md:border-none' => $this->mobileCondense,
			'border-solid' => true,
			'border-bright-turquoise-900' => true,
			'dark:border-bright-turquoise-500' => true,
			'dark2:border-slate-900' => true,
			'dark2:border-t-big-stone-950' => true,
			'rounded-b-xl' => true,
			'md:rounded-none' => $this->mobileCondense,
			'w-56' => true,
			'md:w-auto' => $this->mobileCondense,
			'bg-big-stone-200' => true,
			'md:bg-big-stone-50' => $this->mobileCondense,
			'dark:bg-big-stone-950' => true,
			'md:bg-none' => $this->mobileCondense,
			'toggle-submenu' => true,
			'peer-has-checked:opacity-100' => true,
			'peer-has-checked:z-50' => true,
			'transition-opacity' => true,
		])));

		$this->containerClasses = implode(" ", array_keys(array_filter([
			'relative' => true,
			'flex' => true,
			'flex-col' => true,
			'md:flex-row' => $this->mobileCondense,
			'gap-3' => true,
			'rounded-xl' => true,
			'md:rounded-none' => $this->mobileCondense,
			'dark:bg-black/50' => true,
			'dark2:md:bg-black/50' => $this->mobileCondense,
			'dark2:bg-transparent' => true,
			'w-full' => true,
			'h-full' => true,
			'p-3' => true,
			'md:p-0' => $this->mobileCondense,
			'text-lg' => true,
		])));
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.nav.dropdown');
	}
}
