<?php

namespace App\Traits;

trait CanHaveGitRef
{
	public string|null $refName = null;

	public string|null $refUrl = null;

	protected function refNull(string|null $refName): bool
	{
		return $refName === null;
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
