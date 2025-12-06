<?php

namespace App\View\Components\Nav;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectItem extends Component
{
	/** @noinspection ParameterDefaultsNullInspection */
	public function __construct(
		public string $name,
		public string $id,
		public string $dispatch = '',
		public string $listen = '',
		public string $eventKey = '',
	) {}

	#[\Override]
	public function render(): View
	{
		return view('components.nav.select-item');
	}

	public function dataLabel(): string
	{
		return "{$this->id}_selector";
	}
}
