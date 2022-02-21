<?php

namespace App\Services\Twitter;

use App\Contracts\SocialMediaService;
use App\DataTransferObjects\TweetDTO;
use App\DataTransferObjects\TwitterUserDTO;
use App\Models\Token;
use App\Services\AbstractEndpoint;
use App\Services\Twitter\Endpoints\TokenEndpoint;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TwitterService implements SocialMediaService
{
	/**
	 * The base Twitter API URL
	 */
	private string $api_url = 'https://api.twitter.com';

	/**
	 * The token used for retrieving tweet information from the Twitter API
	 */
	private ?Token $token;

	/**
	 * The API key used for generating the token
	 */
	private string|bool $key;

	/**
	 * The API secret key part used for generating the token
	 */
	private string|bool $secret;

	/**
	 * Create a new instance of the Tweet model
	 *
	 * @method                  __construct
	 * @access public
	 *
	 * @param array             $attributes
	 *
	 * @return void
	 *
	 * This is necessary to initialize some properties that can't otherwise be
	 * initialized. Initializing properties outside of a constrctor requires
	 * that the initial values be static.
	 */
	public function __construct()
	{
		$this->token = Token::whereRaw("LOWER('service') like '%twitter%'")
			->latest()
			->valid()
			->first();

		$this->key = config('services.twitter.key', false);
		$this->secret = config('services.twitter.secret', false);

		if(!$this->key) {
			throw new Exception("Config option 'services.twitter.key' not set.");
		}

		if(!$this->secret) {
			throw new Exception("Config option 'services.twitter.secret' not set.");
		}
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
		return Http::asForm()
			->withHeaders($endpoint->headers)
			->{Str::lower($endpoint->method->value)}(
				$endpoint->url(),
				$endpoint->params
			);
	}

	/**
	 * Get the Twitter API token from Twitter
	 *
	 * This method is intended to be used only if $this->token isn't
	 * set.
	 */
	private function getToken(): Token
	{
		if ($this->token) {
			return $this->token;
		}

		if (!$this->key || !$this->secret) {
			abort(500);
		}

		$response = $this->call(TokenEndpoint::make()->with([
			'Authorization' => "Basic " . base64_encode(urlencode($this->key) . ':' . urlencode($this->secret)),
		]));

		if ($response->failed()) {
			$response->throw();
		}

		if (
			isset($response["errors"]) &&
			count($response["errors"]) >= 1
		) {
			throw new Exception($response["errors"][0]["message"]);
		}

		// $this->token = $response['access_token'];
		$this->token = Token::create([
			'service' => 'twitter',
			'value' => $response['access_token'],
		]);

		return $this->token;
	}

	/**
	 * Get tweets from the Twitter API
	 *
	 * The argument for `$since` must be an ID because this is what the
	 * Twitter API requires to find tweets after a certain point.
	 *
	 * Check these docs for other details:
	 * https://developer.twitter.com/en/docs/twitter-api/v1/tweets/timelines/api-reference/get-statuses-user_timeline
	 */
	public function getPosts(string $username, ?string $since = null, bool $reposts = true, ?int $count = null): Collection
	{
		if(is_int($count) && $count < 1) {
			throw new Exception("'\$count' value cannot be below or equal to 0.");
		}

		if(is_int($count) && $count > 3200) {
			throw new Exception("'\$count' value cannot be greater than 3200.");
		}

		$query = collect([
			'count' => $count,
			'include_rts' => $reposts,
			'screen_name' => $username,
			'since_id' => $since,
		])->reject(fn ($value, $key) => is_null($value));

		$response = Http::withToken($this->getToken()->value)
			->get(
				$this->getUrl("1.1/statuses/user_timeline.json"), $query->toArray()
			);

		if ($response->failed()) {
			$response->throw();
		}

		return collect($response->json())
			->transform(fn ($tweet) => new TweetDTO(
				id: $tweet['id'],
				user: TwitterUserDTO::fromArray($tweet['user']),
				body: $tweet['text'],
				date: TweetDTO::getDate($tweet),
				entities: $tweet['entities'],
			));
	}

	public function getUrl(string $url): string
	{
		return "{$this->api_url}/{$url}";
	}
}
