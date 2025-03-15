<?php

namespace App\View\Components\Github\EventTypes;

use App\Models\GithubEvent;

class PublicEvent extends BaseComponent
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(GithubEvent $event)
	{
		parent::__construct(
			$event->action ?? 'open sourced',
			'fas-globe',
			$event
		);
	}
}
