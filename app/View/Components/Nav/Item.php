<?php

namespace App\View\Components\Nav;

use Closure;
use Illuminate\Contracts\View\View;

class Item extends ItemBase
{
	public function __construct(
		public string $location,
		string|null   $text = null,
		public bool   $wireNavigate = false,
	)
	{
		parent::__construct($text);
	}

	public function render(): View|Closure|string
	{
		return view('components.nav.item');
	}
}
