<?php

namespace App\DataTransferObjects;

readonly class MastodonInstanceInfo
{
	public function __construct(
		public string $domain,
	) {}
}
