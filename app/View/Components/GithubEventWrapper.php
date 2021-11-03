<?php

namespace App\View\Components;

use App\Models\GithubEvent;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Stringable;

class GithubEventWrapper extends Component
{
	public GithubEvent $event;

	public string $eventTypeComponent;

	/**
	 * Kebab-case version of a GitHub event's type
	 *
	 * GitHub's events API sends back the event's type in PascalCase, but kebab-case is needed to find the correct component.
	 */
	public string $type_kebab;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(GithubEvent $event)
	{
		$this->event = $event;
		$this->type_kebab = Str::kebab($this->event->type);
		$this->eventTypeComponent = "github-event-types.{$this->type_kebab}";
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		return view('components.github-event-wrapper');
	}
}
