<?php

namespace App\View\Components\GithubEventTypes;

use App\Models\GithubEvent;
use App\Traits\CanHavePreposition;
use App\Traits\HasIssueNumber;

class IssueCommentEvent extends BaseComponent
{
	use HasIssueNumber,
		CanHavePreposition;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(GithubEvent $event)
	{
		parent::__construct(
			$event->action ?? 'comment on',
			'fas fa-comment',
			$event
		);

		$this->preposition = 'at';
		$this->setIssueNumberText($this->event->source);
	}
}
