<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Timeline extends Component
{
	public string $commonClasses;

	public string $linePositionClass;

	public bool $showDottedLine;

	public bool $showLine;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(bool $showLine = true, bool $showDottedLine = false, string $linePositionClass = 'w-10')
	{
		$this->showLine = $showLine;
		$this->showDottedLine = $showDottedLine;
		$this->linePositionClass = $linePositionClass;
		$this->commonClasses = "absolute {$this->linePositionClass} border-r border-neutral-600";
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		return view('components.timeline');
	}
}
