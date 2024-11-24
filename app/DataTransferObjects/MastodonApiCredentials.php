<?php

namespace App\DataTransferObjects;

readonly class MastodonApiCredentials
{
	public function __construct(
		public string $clientId,
		public string $clientSecret,
		public string $clientDomain,
	) {}
}
