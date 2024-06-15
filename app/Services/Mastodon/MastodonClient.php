<?php

namespace App\Services\Mastodon;

use App\DataTransferObjects\MastodonApiCredentials;

class MastodonClient
{
	public function __construct(
		#[\SensitiveParameter] protected MastodonApiCredentials $credentials,
	) {}
}
