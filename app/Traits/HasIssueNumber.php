<?php

namespace App\Traits;

trait HasIssueNumber
{
	public string $issueNumberText;

	protected function setIssueNumberText(string $issueNumber): void
	{
		$this->issueNumberText = "Issue #$issueNumber";
	}
}
