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
			$result = $this->client
				->tweet()
				->create()
				->performRequest(['text' => $postDTO->stringify()]);

			if ($result?->data?->id && $result?->data?->text) {
				$message = "Successfully posted to X!";

				\Log::info(sprintf(
					"%s\n%s\n",
					$message,
					"https://x.com/{$this->username}/status/{$result->data->id}"
				));

				return new OperationResult(
					succeeded: true,
					message: __("Successfully posted to X!"),
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

		$message = "Unable to post to X.";

		\Log::error($message);

		return new OperationResult(
			succeeded: false,
			message: __($message),
		);
	}
}
