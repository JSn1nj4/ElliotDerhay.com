<?php

use App\Services\Github\Endpoints\ListUserPublicEventsEndpoint;

beforeEach(fn () => $this->faker = \Faker\Factory::create());

it('creates an instance of App\Services\Github\Endpoints\ListUserPublicEventsEndpoint', function (): void {
	expect(new ListUserPublicEventsEndpoint)->toBeInstanceOf(ListUserPublicEventsEndpoint::class);
});

it('sets the \'Authorization\' header', function (): void {
	$test_authorization = 'test_authorization';
	$endpoint = ListUserPublicEventsEndpoint::make()
		->withUser($this->faker->username())
		->with([
			'Authorization' => $test_authorization,
		], [
			'per_page' => $this->faker->numberBetween(1, 100),
		]);

	expect($endpoint->headers['Authorization'])
		->toEqual($test_authorization);
});

it('throws an error if `withUser()` is not called', function (): void {
	ListUserPublicEventsEndpoint::make()
		->with([]);
})->throws(Error::class, "Typed property App\Services\AbstractEndpoint::\$endpoint must not be accessed before initialization");

it('throws an exception if \'Authorization\' header is not passed', function (): void {
	ListUserPublicEventsEndpoint::make()
		->withUser($this->faker->username())
		->with([]);
})->throws(Exception::class);

it('has the correct endpoint value', function (): void {
	$username = $this->faker->username();

	expect(ListUserPublicEventsEndpoint::make()
		->withUser($username)
		->endpoint)
		->toBeString()
		->toEqual("users/{$username}/events/public");
});

it('constructs the correct url with `url()`', function (): void {
	$username = $this->faker->username();

	expect(ListUserPublicEventsEndpoint::make()
		->withUser($username)
		->url())
		->toBeString()
		->toEqual("https://api.github.com/users/{$username}/events/public");
});
