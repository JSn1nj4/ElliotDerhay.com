<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

abstract class HtmlElement extends Component
{
	public function __construct(
		public string $class = '',
		public string $id = '',
	)
	{
		//
	}
}
