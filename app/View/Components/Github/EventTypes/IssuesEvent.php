<?php

namespace App\View\Components\Github\EventTypes;

use App\Models\GithubEvent;
use App\Traits\CanHavePreposition;
use App\Traits\HasIssueNumber;

class IssuesEvent extends BaseComponent
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
		$icons = [
			'opened' => 'far-list-alt',
			'closed' => 'fas-lock',
			'reopened' => 'fas-unlock',
			'assigned' => 'fas-user-plus',
			'unassigned' => 'fas-user-minus',
			'labeled' => 'fas-tag',
			'unlabeled' => 'fas-tag',
		];

		parent::__construct(
			$event->action ?? 'opened',
			$icons[$event->action],
			$event
		);

		$this->preposition = 'at';
		$this->setIssueNumberText($this->event->source);
	}
}
