<?php

use App\Models\Token;
use App\Models\TwitterUser;
use App\Services\Twitter\TwitterService;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Tests\Support\PrivateMemberAccessor;
use Tests\Support\TweetDataFactory;
use Tests\Support\TwitterUserDataFactory;

use function Pest\Faker\faker;

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

it('creates an instance of App\Services\Twitter\TwitterService', function (): void {
	Http::fake([
		"api.twitter.com/oauth2/token*" => Http::response(json_encode(new class {
			public string $token_type = "bearer";
			public string $access_token;
			public function __construct()
			{
				$this->access_token = base64_encode(faker()->word());
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

it('throws an exception if requested tweet count is < 1', function (): void {
	Http::fake([
		"api.twitter.com/oauth2/token*" => Http::response(json_encode(new class {
			public string $token_type = "bearer";
			public string $access_token;
			public function __construct()
			{
				$this->access_token = base64_encode(faker()->word());
			}
		})),
	]);

	(new TwitterService)->getPosts(
		username: faker()->userName(),
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
				$this->access_token = base64_encode(faker()->word());
			}
		})),
	]);

	(new TwitterService)->getPosts(
		username: faker()->userName(),
		count: 3201,
	);
})->throws(Exception::class, "'\$count' value cannot be greater than 3200.");

it('processes a response from the twitter api user timeline endpoint', function (): void {
	$user = faker()->userName();
	$tweetCount = faker()->numberBetween(1, 3200);

	Http::fake([
		"api.twitter.com/oauth2/token*" => Http::response(
			json_encode(new class {
				public string $token_type = "bearer";
				public string $access_token;
				public function __construct()
				{
					$this->access_token = base64_encode(faker()->word());
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

test('`checkForErrors()` does not throw if there are no errors', function (): void {
	Http::fake();

	Token::factory()->makeOne()->save();

	expect(
		PrivateMemberAccessor::make()
			->from(resolve(TwitterService::class))
			->callMethod('checkForErrors', Http::get('https://example.com'))
		)
		->toBeEmpty();
});

test('`checkForErrors()` throws if there was an issue connecting', function (): void {
	Http::fake([
		'*' => Http::response(status: 404),
	]);

	Token::factory()->makeOne()->save();

	PrivateMemberAccessor::make()
		->from(resolve(TwitterService::class))
		->callMethod('checkForErrors', Http::get('https://example.com'));
})->throws(RequestException::class);

test('`checkForErrors()` throws if an error was found in the response', function (): void {
	Http::fake([
		'*' => Http::response(json_encode(new class {
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

	Token::factory()->makeOne()->save();

	PrivateMemberAccessor::make()
		->from(resolve(TwitterService::class))
		->callMethod('checkForErrors', Http::get('https://example.com'));
})->throws(Exception::class, 'Unable to verify your credentials');

it('returns a collection of `TwitterUserDTO` objects from `getUsers()` method', function (): void {
	$users = TwitterUser::factory()
		->count(faker()->numberBetween(1, 100))
		->make();

	/**
	 * Let the `TwitterService` find a fake token in the testing DB,
	 * otherwise it'll create a separate API call to Twitter for the
	 * real thing.
	 */
	Token::factory()->makeOne()->save();

	Http::fake([
		"api.twitter.com/1.1/users/lookup.json*" => Http::response(json_encode(
			$users->map(fn ($user) => TwitterUserDataFactory::init()
					->withUser($user->screen_name, $user->name)
					->makeOne())
				->toArray()
		)),
	]);

	expect(resolve(TwitterService::class)->getUsers($users))
		->toBeInstanceOf(Collection::class)
		->toHaveCount($users->count());
});
