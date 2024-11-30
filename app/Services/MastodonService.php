<?php

namespace App\Services;

use App\Contracts\SocialMediaService;
use App\DataTransferObjects\MastodonApiCredentials;
use App\DataTransferObjects\MastodonInstanceInfo;
use App\DataTransferObjects\OperationResult;
use App\DataTransferObjects\SocialPostDTO;
use App\Http\Clients\MastodonConnector;
use Illuminate\Support\Collection;

class MastodonService implements SocialMediaService
{
	protected MastodonConnector $client;

	public function __construct(MastodonInstanceInfo $instanceInfo, #[\SensitiveParameter] MastodonApiCredentials $credentials)
	{
		$this->client = new MastodonConnector($instanceInfo, $credentials);
	}

	public function getPosts(string $username, ?string $since = null, bool $reposts = true, ?int $count = null): Collection
	{
		// TODO: Implement getPosts() method.
	}

	public function post(SocialPostDTO $postDTO): OperationResult
	{
		// TODO: Implement post() method.
	}
}
