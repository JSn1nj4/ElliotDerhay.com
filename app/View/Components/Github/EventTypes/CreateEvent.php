<?php

namespace App\View\Components\Github\EventTypes;

use App\Models\GithubEvent;
use App\Traits\CanHaveGitRef;
use App\Traits\CanHavePreposition;

class CreateEvent extends BaseComponent
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
			$event->action ?? 'created',
			'far fa-plus-square',
			$event
		);

		$this->hasGitRef = $this->refNotNull($this->event->source);

		if($this->hasGitRef) {
			$this->preposition = 'at';
			$this->setRefName($this->event->source);
			$this->setRefUrl($this->repoUrl());
		}
	}
}
