<?php

namespace App\View\Components\Card;

use Illuminate\View\Component;

class Wrapper extends Component
{
	public string $classes;

	public string $margin;

	public string $padding;

	public string $size;

	public string $type;

	public array $typeClasses = [
		'default' => 'rounded-lg border border-gray-300 dark:border-gray-600 trans-border-color hover:border-seaGreen-600 dark:hover:border-seaGreen-500 bg-white dark:bg-gray-900',
		'transparent' => ''
	];

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(string $size = 'sm', string $type = 'default', ?string $margin = null, ?string $padding = null)
	{
		$this->size = $size;
		$this->type = $type;

		if(isset($margin)) {
			$this->margin = $margin;
		} else if($this->type === 'transparent') {
			$this->margin = '';
		} else {
			$this->margin = 'my-4';
		}

		if(isset($padding)) {
			$this->padding = $padding;
		} else if($this->type === 'transparent') {
			$this->padding = 'px-4';
		} else {
			$this->padding = 'p-4';
		}

		$this->classes = "relative {$this->margin} max-w-{$this->size} w-full z-30 {$this->padding} {$this->typeClasses[$this->type]}";
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		return view('components.card.wrapper');
	}
}
