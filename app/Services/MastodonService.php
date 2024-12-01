<?php

namespace App\Services;

use App\Contracts\SocialMediaService;
use App\DataTransferObjects\OperationResult;
use App\DataTransferObjects\SocialPostDTO;
use App\Http\Clients\MastodonConnector;
use Illuminate\Support\Collection;

class MastodonService implements SocialMediaService
{
	public function __construct(
		protected MastodonConnector|null $client = null,
	)
	{
		$this->client ??= resolve(MastodonConnector::class);
	}

	public function registerApp()
	{
		// return
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
