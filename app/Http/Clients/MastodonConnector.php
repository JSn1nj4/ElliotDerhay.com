<?php

namespace App\Http\Clients;

use App\DataTransferObjects\MastodonApiCredentials;
use App\DataTransferObjects\MastodonInstanceInfo;
use Saloon\Http\Connector;

class MastodonConnector extends Connector
{
	public function __construct(
		protected MastodonInstanceInfo   $instance,
		protected MastodonApiCredentials $credentials,
	) {}

	public function resolveBaseUrl(): string
	{
		return "https://{$this->instance->domain}/api/v1";
	}

	protected function defaultHeaders(): array
	{
		return [
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
		];
	}
}
