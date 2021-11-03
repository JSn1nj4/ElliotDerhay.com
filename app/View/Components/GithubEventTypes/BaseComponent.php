<?php

namespace App\View\Components\GithubEventTypes;

use App\Models\GithubEvent;
use App\Traits\DisplaysTimeElapsed;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use ReflectionClass;

class BaseComponent extends Component
{
	use DisplaysTimeElapsed;

	public string $action;

	protected string $baseLink = 'https://github.com';

	public GithubEvent $event;

	public string $icon;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(string $action, string $icon, GithubEvent $event)
	{
		$this->action = $action;
		$this->icon = $icon;
		$this->event = $event;

		$this->setTimeElapsedString($this->event->date);
	}

	public function profileUrl(): string
	{
		return "{$this->baseLink}/{$this->event->user->display_login}";
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		$reflect = new ReflectionClass($this);

		return view('components.github-event-types.' . Str::kebab($reflect->getShortName()));
	}

	public function repoUrl(): string
	{
		return "{$this->baseLink}/{$this->event->repo}";
	}
}
