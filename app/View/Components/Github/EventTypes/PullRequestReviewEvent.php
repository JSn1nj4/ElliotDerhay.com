<?php

namespace App\View\Components\Github\EventTypes;

use App\Models\GithubEvent;
use App\Traits\CanHavePreposition;
use App\Traits\HasPullRequestNumber;

class PullRequestReviewEvent extends BaseComponent
{
	use CanHavePreposition,
		HasPullRequestNumber;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(GithubEvent $event)
	{
		parent::__construct(
			$event->action ?? 'reviewed',
			'fas fa-edit',
			$event
		);

		$this->preposition = 'at';
		$this->setPullRequestNumberText($this->event->source);
	}
}
