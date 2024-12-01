<?php

namespace App\Http\Authenticators;

use App\DataTransferObjects\MastodonApiCredentials;
use App\DataTransferObjects\MastodonTokenRequestCredentials;
use Saloon\Contracts\Authenticator;
use Saloon\Data\MultipartValue;
use Saloon\Http\PendingRequest;

class MastodonClientCredentialAuthenticator implements Authenticator
{
	public function __construct(
		protected MastodonApiCredentials          $apiCredentials,
		protected MastodonTokenRequestCredentials $tokenRequestCredentials,
	) {}

	/**
	 * @inheritDoc
	 */
	public function set(PendingRequest $pendingRequest): void
	{
		$pendingRequest->body()->set([
			new MultipartValue('client_id', $this->apiCredentials->clientId),
			new MultipartValue('client_secret', $this->apiCredentials->clientSecret),
			new MultipartValue('code', $this->tokenRequestCredentials->code),
		]);
	}
}
