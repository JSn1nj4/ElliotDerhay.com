<?php

namespace App\DataTransferObjects;

readonly class MastodonAppInfo
{
	public function __construct(
		public string $client_name,
		public string $redirect_uris,
		public string $scopes,
		public string $website,
	) {}
}
