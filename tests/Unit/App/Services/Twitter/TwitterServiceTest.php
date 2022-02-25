<?php

use App\Services\Twitter\TwitterService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Tests\Support\TweetDataFactory;

function requestHasParams(Request $request, array $params): bool {
	return collect($params)
		->every(fn ($value, $key) => (
			isset($request[$key]) &&
			$request[$key] === $value
		));
}

function requestMissingParams(Request $request, array $params): bool {
	return collect($params)
		->every(fn ($value, $key) => !isset($request[$key]));
}

beforeEach(function (): void {
	$this->api_base = 'https://api.twitter.com';

	$this->faker = \Faker\Factory::create();
});

it('creates an instance of App\Services\Twitter\TwitterService', function (): void {
	Http::fake([
		"api.twitter.com/oauth2/token*" => Http::response(json_encode(new class {
			public string $token_type = "bearer";
			public string $access_token;
			public function __construct()
			{
				$this->access_token = base64_encode(\Faker\Factory::create()->word());
			}
		})),
	]);

	expect(new TwitterService)->toBeInstanceOf(TwitterService::class);
});

it('throws an exception if api key is not set', function (): void {
	Config::offsetUnset('services.twitter.key');

	new TwitterService;
})->throws(TypeError::class);

it('throws an exception if api secret is not set', function (): void {
	Config::offsetUnset('services.twitter.secret');

	new TwitterService;
})->throws(TypeError::class);

it('throws an exception if no valid api token is found', function (): void {
	Http::fake([
		"api.twitter.com/oauth2/token*" => Http::response(json_encode(new class {
			public array $errors = [];
			public function __construct()
			{
				$this->errors[] = new class {
					public int $code = 99;
					public string $message = "Unable to verify your credentials";
					public string $label = "authenticity_token_error";
				};
			}
		})),
	]);

	new TwitterService;
})->throws(Exception::class, "Unable to verify your credentials");

it('throws an exception if requested tweet count is < 1', function (): void {
	Http::fake([
		"api.twitter.com/oauth2/token*" => Http::response(json_encode(new class {
			public string $token_type = "bearer";
			public string $access_token;
			public function __construct()
			{
				$this->access_token = base64_encode(\Faker\Factory::create()->word());
			}
		})),
	]);

	(new TwitterService)->getPosts(
		username: $this->faker->userName(),
		count: 0,
	);
})->throws(Exception::class, "'\$count' value cannot be below or equal to 0.");

/**
 * Check these docs for the maximum tweets that can be requested
 * https://developer.twitter.com/en/docs/twitter-api/v1/tweets/timelines/api-reference/get-statuses-user_timeline
 */
it('throws an exception if requested tweet count is > 3200', function (): void {
	Http::fake([
		"api.twitter.com/oauth2/token*" => Http::response(json_encode(new class {
			public string $token_type = "bearer";
			public string $access_token;
			public function __construct()
			{
				$this->access_token = base64_encode(\Faker\Factory::create()->word());
			}
		})),
	]);

	(new TwitterService)->getPosts(
		username: $this->faker->userName(),
		count: 3201,
	);
})->throws(Exception::class, "'\$count' value cannot be greater than 3200.");

it('processes a response from the twitter api user timeline endpoint', function (): void {
	$user = $this->faker->userName();
	$tweetCount = $this->faker->numberBetween(1, 3200);

	Http::fake([
		"api.twitter.com/oauth2/token*" => Http::response(
			json_encode(new class {
				public string $token_type = "bearer";
				public string $access_token;
				public function __construct()
				{
					$this->access_token = base64_encode(\Faker\Factory::create()->word());
				}
			}),
		),
		"api.twitter.com/1.1/statuses/user_timeline.json*" => Http::response(json_encode(TweetDataFactory::init()
			->user($user)
			->count($tweetCount)
			->make())),
		"*" => Http::response(),
	]);

	$tweets = (new TwitterService)->getPosts(
		username: $user,
		count: $tweetCount,
	);

	expect($tweets)
		->toBeInstanceOf(Collection::class);

	expect(count($tweets))
		->toBeLessThanOrEqual($tweetCount);
});
