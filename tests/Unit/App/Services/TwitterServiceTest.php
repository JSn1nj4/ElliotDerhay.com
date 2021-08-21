<?php

use App\Services\TwitterService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

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

it('creates an instance of App\Services\TwitterService', function (): void {
	expect(new TwitterService)->toBeInstanceOf(TwitterService::class);
});

it('throws an exception if api key is not set', function (): void {
	Config::offsetUnset('services.twitter.key');

	new TwitterService;
})->throws(Exception::class, "Config option 'services.twitter.key' not set.");

it('throws an exception if api secret is not set', function (): void {
	Config::offsetUnset('services.twitter.secret');

	new TwitterService;
})->throws(Exception::class, "Config option 'services.twitter.secret' not set.");

it('constructs the correct api url', function (): void {
	$twitterService = new TwitterService;

	$api_endpoint = "1.1/statuses/user_timeline.json";

	expect($twitterService->getUrl($api_endpoint))
		->toBeString()
		->toEqual("{$this->api_base}/{$api_endpoint}");
});

it('constructs a correctly-formatted token api request', function(): void {
	$token = base64_encode($this->faker->word());

	$response = (object) [
		'body' => (object) [
			"token_type" => "bearer",
			"access_token" => $token,
		],
		'status' => 200,
		'headers' => []
	];

	Http::fake([
		"api.twitter.com/oauth2/token*" => Http::response(
			json_encode($response->body),
			$response->status,
			$response->headers
		),
	]);

	(new TwitterService)->getToken();

	Http::assertSent(function (Request $request) {
		$authorization = base64_encode(config('services.twitter.key') . ':' . config('services.twitter.secret'));

		$tokenUrl = "{$this->api_base}/oauth2/token";

		return $request->url() === $tokenUrl &&
			$request->hasHeaders([
				"Authorization" => "Basic {$authorization}",
				"Content-Type" => "application/x-www-form-urlencoded",
				"Content-Length" => "29",
			]) &&
			requestHasParams($request, [
				'grant_type' => 'client_credentials',
			]);
	});
});

it('throws an exception if no valid api token is found', function (): void {
	Http::fake([
		"api.twitter.com/oauth2/token*" => Http::response(json_encode((object) ["errors" => [
			(object) [
				"code" => 99,
				"message" => "Unable to verify your credentials",
				"label" => "authenticity_token_error",
			],
		]])),
	]);

	(new TwitterService)->getToken();
})->throws(Exception::class, "Unable to verify your credentials");

it('constructs a correctly-formatted user timeline api request', function (): void {
	$requestParams = collect([
		'count' => $this->faker->randomElement([
			$this->faker->numberBetween(1, 100),
			$this->faker->numberBetween(1, 100),
			$this->faker->numberBetween(1, 100),
			$this->faker->numberBetween(1, 100),
			null,
		]),
		'include_rts' => false,
		// 'include_rts' => $this->faker->boolean(),
		'screen_name' => $this->faker->userName(),
		'since_id' => $this->faker->randomElement([
			$this->faker->numerify('##########'),
			$this->faker->numerify('##########'),
			$this->faker->numerify('##########'),
			$this->faker->numerify('##########'),
			null,
		]),
	]);

	[$expectedParams, $unexpectedParams] = $requestParams->partition(
		fn ($value, $key) => !is_null($value)
	);

	$token = base64_encode($this->faker->word());

	Http::fake([
		"api.twitter.com/oauth2/token*" => Http::response(
			json_encode((object) [
				"token_type" => "bearer",
				"access_token" => $token,
			]),
		),
		"*" => Http::response(),
	]);

	$twitterService = new TwitterService;

	$twitterService->getToken();

	Http::assertSent(fn () => true);

	$twitterService->getPosts(
		username: $requestParams->get('screen_name'),
		since: $requestParams->get('since_id'),
		reposts: $requestParams->get('include_rts'),
		count: $requestParams->get('count'),
	);

	Http::assertSent(function (Request $request) use (
		$expectedParams,
		$token,
	) {
		$requestUrl = "{$this->api_base}/1.1/statuses/user_timeline.json?";

		$requestUrl .= $expectedParams->map(function ($value, $key) {
			if($key === "include_rts") {
				return "{$key}=" . (int)$value;
			}

			return "{$key}={$value}";
		})->implode('&');

		return $request->url() === $requestUrl &&
			$request->hasHeaders([
				"Authorization" => "Bearer {$token}",
			]);
	});
});
