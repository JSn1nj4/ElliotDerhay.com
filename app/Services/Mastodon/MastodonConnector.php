<?php

namespace App\Services\Mastodon;

use App\DataTransferObjects\MastodonApiCredentials;
use Saloon\Http\Connector;

class MastodonConnector extends Connector
{
	public function __construct(
		protected string                 $host,
		protected MastodonApiCredentials $credentials,
	) {}

	public function resolveBaseUrl(): string
	{
		return "https://{$this->host}/api/v1";
	}

	protected function defaultHeaders(): array
	{
		return [
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
		];
	}
}
