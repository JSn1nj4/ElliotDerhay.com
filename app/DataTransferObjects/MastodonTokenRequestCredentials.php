<?php

namespace App\DataTransferObjects;

readonly class MastodonTokenRequestCredentials
{
	public function __construct(
		public string $code,
	) {}
}
