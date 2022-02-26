<?php

use App\Services\Twitter\Endpoints\UsersLookupEndpoint;

it('creates an instance of App\Services\Twitter\Endpoints\UsersLookupEndpoint', function (): void {
	expect(new UsersLookupEndpoint)->toBeInstanceOf(UsersLookupEndpoint::class);
});

it('sets the \'screen_name\' param', function (): void {
	$test_screen_name = 'test_screen_name';
	$endpoint = UsersLookupEndpoint::make()
		->with([], [
			'screen_name' => $test_screen_name,
		]);

	expect($endpoint)
		->toBeInstanceOf(UsersLookupEndpoint::class)
		->and($endpoint->params['screen_name'])
		->toEqual($test_screen_name);
});

it('throws an exception if \'screen_name\' param is not passed', function (): void {
	UsersLookupEndpoint::make()->with([], []);
})->throws(Exception::class, "Param 'screen_name' is required for endpoint 'https://api.twitter.com/1.1/users/lookup.json'");

it('has the correct endpoint value', function (): void {
	expect(UsersLookupEndpoint::make()->endpoint)
		->toBeString()
		->toEqual('1.1/users/lookup.json');
});

it('constructs the correct url with `url()`', function (): void {
	$full_url = "https://api.twitter.com/1.1/users/lookup.json";

	expect(UsersLookupEndpoint::make()->url())
		->toBeString()
		->toEqual($full_url);
});
