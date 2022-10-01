<?php

namespace App\View\Components\Github\EventTypes;

use App\Models\GithubEvent;

class WatchEvent extends BaseComponent
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(GithubEvent $event)
	{
		parent::__construct(
			$event->action ?? 'starred',
			'fas fa-star',
			$event
		);
	}
}
