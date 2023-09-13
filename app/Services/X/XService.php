<?php

namespace App\Services\X;

use App\Contracts\SocialMediaService;
use App\DataTransferObjects\OperationResult;
use App\DataTransferObjects\SocialPostDTO;
use App\DataTransferObjects\TokenDTO;
use Illuminate\Support\Collection;

class XService implements SocialMediaService
{

	public function __construct(TokenDTO $token)
	{

	}

	/**
	 * This method is not implemented due to Twitter/X implementing tight API limitations on free integrations when the ne    w plans were introduced.
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
