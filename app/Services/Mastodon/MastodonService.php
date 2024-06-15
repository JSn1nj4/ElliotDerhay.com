<?php

namespace App\Services\Mastodon;

use App\Contracts\SocialMediaService;
use App\DataTransferObjects\MastodonApiCredentials;
use App\DataTransferObjects\OperationResult;
use App\DataTransferObjects\SocialPostDTO;
use Illuminate\Support\Collection;

class MastodonService implements SocialMediaService
{
	protected MastodonClient $client;

	public function __construct(#[\SensitiveParameter] MastodonApiCredentials $credentials)
	{
		$this->client = new MastodonClient($credentials);
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
