<?php

namespace App\Services;

use App\Contracts\SocialMediaService;
use App\DataTransferObjects\TweetDTO;
use App\DataTransferObjects\TwitterUserDTO;
use App\Models\Token;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class TwitterService implements SocialMediaService
{
	/**
	 * The base Twitter API URL
	 *
	 * @property string         $api_url
	 * @access private
	 */
	private $api_url = 'https://api.twitter.com';

	/**
	 * The token used for retrieving tweet information from the Twitter API
	 *
	 * @property string         $token
	 * @access private
	 */
	private $token;

	/**
	 * The API key used for generating the token
	 *
	 * @property string         $key
	 * @access private
	 */
	private $key;

	/**
	 * The API secret key part used for generating the token
	 *
	 * @property string         $secret
	 * @access private
	 */
	private $secret;

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
	 * Get the Twitter API token
	 *
	 * Generate a new one if necessary.
	 *
	 * @method                  getToken
	 * @access public
	 *
	 * @return App\Models\Token;
	 *
	 * The 'if' in this case has to do with whether Twitter already has a token
	 * for use. If the token hasn't been generated previously or if the previous
	 * token was revoked, then this function will be used to ask Twitter for a
	 * new one.
	 *
	 * This method will also only be called if the token doesn't already exist
	 * in the environment.
	 */
	public function getToken()
	{
		if ($this->token) {
			return $this->token;
		}

		if (!$this->key || !$this->secret) {
			abort(500);
		}

		$auth_hash = base64_encode(urlencode($this->key) . ':' . urlencode($this->secret));

		$response = Http::asForm()->withHeaders([
			'Authorization' => "Basic {$auth_hash}",
		])->post($this->getUrl("oauth2/token"), [
			'grant_type' => 'client_credentials',
		]);

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
	 */
	public function getPosts(string $username, ?string $since = null, bool $reposts = true, ?int $count = null): Collection
	{
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
