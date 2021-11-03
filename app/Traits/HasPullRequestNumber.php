<?php

namespace App\Traits;

trait HasPullRequestNumber
{
	public string $pullRequestNumberText;

	protected function setPullRequestNumberText(string $pullRequestNumber): void
	{
		$this->pullRequestNumberText = "Pull Request #$pullRequestNumber";
	}
}
