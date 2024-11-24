<?php

namespace App\DataTransferObjects;

readonly class MastodonApiCredentials
{
	public function __construct(
		public string $clientName,
		public string $clientDomain,
		public string $clientKey,
		public string $clientSecret,
	) {}
}
