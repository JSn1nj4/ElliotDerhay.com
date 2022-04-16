<?php

namespace App\View\Components\GithubEventTypes;

use App\Models\GithubEvent;
use App\Traits\HasIssueNumber;
use App\Traits\CanHavePreposition;

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
			'opened' => 	'far fa-list-alt',
			'closed' => 	'fas fa-lock',
			'reopened' => 	'fas fa-unlock',
			'assigned' => 	'fas fa-user-plus',
			'unassigned' =>	'fas fa-user-minus',
			'labeled' => 	'fas fa-tag',
			'unlabeled' =>	'fas fa-tag',
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
