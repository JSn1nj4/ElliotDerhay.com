<?php

namespace App\View\Components\Github\EventTypes;

use App\Models\GithubEvent;

class PullRequestReviewEvent extends BaseComponent
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(GithubEvent $event)
	{
		parent::__construct(
			$event->action ?? 'reviewed a PR on',
			'fas fa-edit',
			$event
		);

		// $this->preposition = 'at';
		// $this->setPullRequestNumberText($this->event->source);
	}
}
