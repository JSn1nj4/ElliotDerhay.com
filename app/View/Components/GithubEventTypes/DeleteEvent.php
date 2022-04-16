<?php

namespace App\View\Components\GithubEventTypes;

use App\Models\GithubEvent;
use App\Traits\CanHaveGitRef;
use App\Traits\CanHavePreposition;

class DeleteEvent extends BaseComponent
{
	use CanHaveGitRef,
		CanHavePreposition;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(GithubEvent $event)
	{
		parent::__construct(
			$event->action ?? 'deleted',
			'far fa-trash-alt',
			$event
		);

		$this->preposition = 'from';
		$this->setRefName($this->event->source);
		$this->setRefUrl($this->repoUrl());
	}
}
