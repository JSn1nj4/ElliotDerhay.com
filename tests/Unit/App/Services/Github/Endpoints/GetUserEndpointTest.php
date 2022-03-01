<?php

use App\Services\Github\Endpoints\GetUserEndpoint;

beforeEach(fn () => $this->faker = \Faker\Factory::create());

it('creates an instance of App\Services\Github\Endpoints\GetUserEndpoint', function (): void {
	expect(new GetUserEndpoint)->toBeInstanceOf(GetUserEndpoint::class);
});

it('sets the \'Authorization\' header', function (): void {
	$test_authorization = 'test_authorization';
	$endpoint = GetUserEndpoint::make()
		->withUser($this->faker->username())
		->with([
			'Authorization' => $test_authorization,
		]);

	expect($endpoint->headers['Authorization'])
		->toEqual($test_authorization);
});

it('throws an error if `withUser()` is not called', function (): void {
	GetUserEndpoint::make()
		->with([]);
})->throws(Error::class, "Typed property App\Services\AbstractEndpoint::\$endpoint must not be accessed before initialization");

it('throws an exception if \'Authorization\' header is not passed', function (): void {
	GetUserEndpoint::make()
		->withUser($this->faker->username())
		->with([]);
})->throws(Exception::class);

it('has the correct endpoint value', function (): void {
	$username = $this->faker->username();

	expect(GetUserEndpoint::make()
			->withUser($username)
			->endpoint)
		->toBeString()
		->toEqual("users/{$username}");
});

it('constructs the correct url with `url()`', function (): void {
	$username = $this->faker->username();

	expect(GetUserEndpoint::make()
			->withUser($username)
			->url())
		->toBeString()
		->toEqual("https://api.github.com/users/{$username}");
});



