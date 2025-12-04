<?php

namespace App\View\Components\Nav;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectItem extends Component
{
	public function __construct(
		public string      $name,
		public string      $id,
		public string|null $label = null,
	) {}

	#[\Override]
	public function render(): View
	{
		return view('components.nav.select-item');
	}
}
