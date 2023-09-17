<?php

namespace App\Services\X;

use App\Contracts\SocialMediaService;
use App\DataTransferObjects\OperationResult;
use App\DataTransferObjects\SocialPostDTO;
use App\DataTransferObjects\XApiCredentials;
use Illuminate\Support\Collection;
use Noweh\TwitterApi\Client as TwitterClient;

class XService implements SocialMediaService
{
	protected TwitterClient $client;

	public function __construct(XApiCredentials $credentials)
	{
		$this->client = new TwitterClient($credentials->all());
	}

	/**
	 * This method is not implemented due to Twitter/X implementing tight API limitations on free integrations when the new plans were introduced.
	 * @unstable
	 * @param string $username
	 * @param string|null $since
	 * @param bool $reposts
	 * @param int|null $count
	 * @return \Illuminate\Support\Collection
	 */
	public function getPosts(string $username, string|null $since = null, bool $reposts = true, int|null $count = null): Collection
	{
		return collect([]);
	}

	public function post(SocialPostDTO $postDTO): OperationResult
	{
		return new OperationResult(
			succeeded: false,
			message: __(":method method is not implemented.", [
				'method' => $this::class . "::post",
			]),
		);
	}
}
