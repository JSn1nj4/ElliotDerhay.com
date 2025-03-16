<?php

namespace App\View\Components\Github\EventTypes;

use App\Models\GithubEvent;
use App\Traits\CanHavePreposition;

class ReleaseEvent extends BaseComponent
{
	use CanHavePreposition;

	public string $releaseText;

	public string $releaseUrl;

	/**
	 * Create a new component instance.
	 */
	public function __construct(GithubEvent $event)
	{
		parent::__construct(
			action: $event->action,
			icon: 'fas-tag',
			event: $event,
		);

		$this->preposition = 'at';
		$this->releaseUrl = $event->source;
		$this->releaseText = str($event->source)->after('releases/');
	}
}
