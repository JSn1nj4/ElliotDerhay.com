<?php

namespace App\View\Components\Github\EventTypes;

use App\Models\GithubEvent;

class PullRequestReviewCommentEvent extends BaseComponent
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(GithubEvent $event)
	{
		parent::__construct(
			$event->action ?? 'posted a review comment on',
			'fas fa-comment-alt',
			$event
		);

		// $this->preposition = 'at';
		// $this->setPullRequestNumberText($this->event->source);
	}
}
