<?php

namespace App\View\Components\Github\EventTypes;

use App\Models\GithubEvent;
use App\Traits\CanHaveGitRef;
use App\Traits\CanHavePreposition;

class CommitCommentEvent extends BaseComponent
{
	use CanHaveGitRef,
		CanHavePreposition;

	public function __construct(GithubEvent $event)
	{
		parent::__construct(
			action: $event->action,
			icon: 'fas fa-comment',
			event: $event,
		);

		if ($this->refNull($this->event->source)) return;

		$this->preposition = 'at';
		$this->setRefName(str($this->event->source)->limit(7, ''));

		if (str($this->action)->contains('deleted', true)) return;

		$this->setRefUrl($this->repoUrl());
	}
}
