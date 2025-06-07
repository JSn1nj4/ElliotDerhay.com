<?php

namespace App\Services;

use App\Contracts\SocialMediaService;
use App\DataTransferObjects\OperationResult;
use App\DataTransferObjects\SocialPostDTO;
use App\DataTransferObjects\XApiCredentials;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Noweh\TwitterApi\Client as TwitterClient;

class XService implements SocialMediaService
{
	protected TwitterClient $client;
	protected string $username;

	public function __construct(XApiCredentials $credentials, string|null $username = null)
	{
		$this->client = new TwitterClient($credentials->all());

		if (!$username) $this->username = config('services.x.username');
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
		try {
			$newPost = $postDTO;
			$parentPostId = null;

			$attemps = 0;
			$successes = 0;

			while ($newPost !== null) {
				$attemps++;

				$postData = ['text' => $postDTO->stringify()];
				if ($parentPostId !== null) {
					$postData['reply'] ??= [];

					$postData['reply']['in_reply_to_tweet_id'] = $parentPostId;
				}

				// todo: implement caching
				$result = $this->client
					->tweet()
					->create()
					->performRequest(postData: $postData, withHeaders: true);

				if ($result?->data?->id && $result?->data?->text) {
					$message = "Successfully posted to X!";

					\Log::info(sprintf(
						"%s\n%s\n",
						$message,
						"https://x.com/{$this->username}/status/{$result->data->id}"
					));

					// todo: remove once caching figured out
					\Log::info("{$result->headers}\n");

					$successes++;

					$parentPostId = $result->data->id;
					$newPost = $newPost->subpost;
				}
			}


			if ($successes === $attemps) {
				return new OperationResult(
					succeeded: true,
					message: __("Successfully posted all posts to X!"),
				);
			}

		} catch (GuzzleException $exception) {
			$message = "Guzzle Exception: {$exception->getMessage()}";

			\Log::error($message);

			return new OperationResult(false, __($message));

		} catch (\RuntimeException $exception) {
			$message = "Runtime Exception: {$exception->getMessage()}";

			\Log::error($message);

			return new OperationResult(false, __($message));

		} catch (\Exception $exception) {
			\Log::error($exception->getMessage());

			return new OperationResult(
				succeeded: false,
				message: __($exception->getMessage()),
			);
		}

		$message = "Ran into problems posting to X.";

		\Log::error($message);

		return new OperationResult(
			succeeded: false,
			message: __($message),
		);
	}
}
