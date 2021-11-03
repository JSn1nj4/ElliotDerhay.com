<?php

namespace App\View\Components\GithubEventTypes;

use App\Models\GithubEvent;
use App\Traits\HasPreposition;

class ForkEvent extends BaseComponent
{
	use HasPreposition;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(GithubEvent $event)
	{
		parent::__construct(
			$event->action ?? 'forked',
			'fas fa-code-branch',
			$event
		);

		$this->preposition = 'from';
	}
}
