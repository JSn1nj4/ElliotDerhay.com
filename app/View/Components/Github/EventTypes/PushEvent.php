<?php

namespace App\View\Components\Github\EventTypes;

use App\Models\GithubEvent;
use App\Traits\CanHaveGitRef;
use App\Traits\CanHavePreposition;

class PushEvent extends BaseComponent
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
			$event->action ?? 'pushed to',
			'far fa-arrow-alt-circle-up',
			$event
		);

		$this->preposition = 'at';
		$this->setRefName($this->event->source);
		$this->setRefUrl($this->repoUrl());
	}
}
