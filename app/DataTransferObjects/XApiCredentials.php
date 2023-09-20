<?php

namespace App\DataTransferObjects;

/**
 * 'Consumer Key' is also called 'API Key', and 'Consumer Secret' is also called 'API Secret'.
 */
readonly class XApiCredentials
{
	public function __construct(
		public int    $account_id,
		public string $access_token,
		public string $access_token_secret,
		public string $consumer_key,
		public string $consumer_secret,
		public string $bearer_token,
	)
	{
	}

	public function all(): array
	{
		return [
			'account_id' => $this->account_id,
			'access_token' => $this->access_token,
			'access_token_secret' => $this->access_token_secret,
			'consumer_key' => $this->consumer_key,
			'consumer_secret' => $this->consumer_secret,
			'bearer_token' => $this->bearer_token,
		];
	}
}
