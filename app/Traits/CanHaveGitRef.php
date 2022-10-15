<?php

namespace App\Traits;

trait CanHaveGitRef
{
	public bool $hasGitRef = false;

	public ?string $refName = null;

	public ?string $refUrl = null;

	protected function refNotNull(?string $refName): bool
	{
		return is_string($refName);
	}

	protected function setRefName(string $ref): void
	{
		$this->refName = str_replace('refs/heads/', '', $ref);
	}

	protected function setRefUrl(string $repoUrl): void
	{
		$this->refUrl = "{$repoUrl}/tree/{$this->refName}";
	}
}
