<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GoogleAnalytics extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public readonly string $googleAnalyticsId = 'G-N77DW1F89N',
	) {}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View
	{
		return view('components.google-analytics');
	}
}
