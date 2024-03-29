<?php

namespace App\Services\Twitter;

use App\Contracts\SocialMediaService;
use App\DataTransferObjects\OperationResult;
use App\DataTransferObjects\SocialPostDTO;
use App\DataTransferObjects\TweetDTO;
use App\DataTransferObjects\TwitterUserDTO;
use App\Features\TwitterFeed;
use App\Models\Token;
use App\Services\AbstractEndpoint;
use App\Services\Twitter\Endpoints\TokenEndpoint;
use App\Services\Twitter\Endpoints\UsersLookupEndpoint;
use App\Services\Twitter\Endpoints\UserTimelineEndpoint;
use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Laravel\Pennant\Feature;

class TwitterService implements SocialMediaService
{
	/**
	 * The token used for retrieving tweet information from the Twitter API
	 */
	private Token|null $token;

	/**
	 * The API key used for generating the token
	 */
	private string $key;

	/**
	 * The API secret key part used for generating the token
	 */
	private string $secret;

	/**
	 * Create a new instance of the Tweet model
	 *
	 * This is necessary to initialize some properties that can't otherwise be
	 * initialized. Initializing properties outside the constructor requires
	 * that the initial values be static.
	 * @throws Exception
	 */
	public function __construct(Token|null $token)
	{
		if (Feature::inactive(TwitterFeed::class)) {
			throw new Exception("TwitterFeed feature is disabled.");
		}

		$this->key = config('services.twitter.key');
		$this->secret = config('services.twitter.secret');

		$this->token = $token ?? $this->getToken();
	}

	/**
	 * Call a specified Twitter API endpoint
	 *
	 * @todo: make this more generic or find way to jump between helper
	 * methods like Http::asForm() or Http::withToken() as needed,
	 * otherwise this will become messy. The former may require the
	 * endpoint classes knowing what encoding or other specific
	 * request format is required besides request headers and params.
	 */
	public function call(AbstractEndpoint $endpoint): Response
	{
		$endpoint_map = [
			'asForm' => [
				TokenEndpoint::class,
			],
		];

		return with(
			Http::withHeaders($endpoint->headers),
			fn (PendingRequest $pendingRequest): PendingRequest => match (true) {
				in_array($endpoint::class, $endpoint_map['asForm']) => $pendingRequest->asForm(),
				default => $pendingRequest,
			}
		)
			->{Str::lower($endpoint->method->value)}(
				$endpoint->url(),
				$endpoint->params
			);
	}

	/**
	 * Check HTTP responses for errors
	 */
	private function checkForErrors(Response $response): void
	{
		if ($response->failed()) $response->throw();

		if (!isset($response["errors"])) return;

		if (count($response["errors"]) < 1) return;

		throw new Exception($response["errors"][0]["message"]);
	}

	/**
	 * Get the Twitter API token from Twitter
	 *
	 * This method is intended to be used only if $this->token isn't
	 * set.
	 * @throws Exception
	 */
	private function getToken(): Token
	{
		$response = $this->call(TokenEndpoint::make()->with([
			'Authorization' => "Basic " . base64_encode(urlencode($this->key) . ':' . urlencode($this->secret)),
		]));

		$this->checkForErrors($response);

		return Token::create([
			'service' => 'twitter',
			'value' => $response['access_token'],
		]);
	}

	/**
	 * Get tweets from the Twitter API
	 *
	 * The argument for `$since` must be an ID because this is what the
	 * Twitter API requires to find tweets after a certain point.
	 *
	 * Check these docs for other details:
	 * https://developer.twitter.com/en/docs/twitter-api/v1/tweets/timelines/api-reference/get-statuses-user_timeline
	 * @throws Exception
	 */
	public function getPosts(string $username, string|null $since = null, bool $reposts = true, int|null $count = null): Collection
	{
		if (is_int($count) && $count < 1) {
			throw new Exception("'\$count' value cannot be below or equal to 0.");
		}

		if (is_int($count) && $count > 3200) {
			throw new Exception("'\$count' value cannot be greater than 3200.");
		}

		$response = $this->call(UserTimelineEndpoint::make()->with(
			headers: [
				"Authorization" => "Bearer {$this->token->value}",
			],
			params: collect([
				'count' => $count,
				'include_rts' => $reposts,
				'screen_name' => $username,
				'since_id' => $since,
			])->reject(fn ($value, $key) => is_null($value))
				->toArray())
		);

		$this->checkForErrors($response);

		return collect($response->json())
			->transform(fn ($tweet) => new TweetDTO(
				id: $tweet['id'],
				user: TwitterUserDTO::fromArray($tweet['user']),
				body: $tweet['text'],
				date: TweetDTO::getDate($tweet),
				entities: $tweet['entities'],
			));
	}

	/**
	 * @param Collection $users
	 * @return Collection
	 * @throws Exception
	 */
	public function getUsers(Collection $users): Collection
	{
		$response = $this->call(UsersLookupEndpoint::make()->with(
			headers: [
				"Authorization" => "Bearer {$this->token->value}",
			],
			params: [
				"screen_name" => $users->implode('screen_name', ','),
			],
		));

		$this->checkForErrors($response);

		return collect($response->json())
			->transform(fn ($user) => new TwitterUserDTO(
				id: $user['id'],
				name: $user['name'],
				screen_name: $user['screen_name'],
				profile_image_url_https: $user['profile_image_url_https'],
			));
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
