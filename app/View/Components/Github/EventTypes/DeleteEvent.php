<?php

namespace App\View\Components\Github\EventTypes;

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
			'far-trash-alt',
			$event
		);

		if ($this->refNull($this->event->source)) return;

		$this->preposition = 'from';
		$this->setRefName($this->event->source);
		$this->setRefUrl($this->repoUrl());
	}
}
