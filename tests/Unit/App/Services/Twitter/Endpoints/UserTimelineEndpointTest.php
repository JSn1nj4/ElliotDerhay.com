<?php

use App\Services\Twitter\Endpoints\UserTimelineEndpoint;

it('creates an instance of App\Services\Twitter\Endpoints\UserTimelineEndpoint', function (): void {
	expect(new UserTimelineEndpoint)->toBeInstanceOf(UserTimelineEndpoint::class);
});

it('sets the \'Authorization\' header', function (): void {
	$test_authorization = 'test_authorization';
	$endpoint = UserTimelineEndpoint::make()
		->with([
			'Authorization' => $test_authorization,
		]);

	expect($endpoint->headers['Authorization'])
		->toEqual($test_authorization);
});

it('throws an exception if \'Authorization\' header is not passed', function (): void {
	UserTimelineEndpoint::make()->with([]);
})->throws(Exception::class, "Header 'Authorization' is required for endpoint 'https://api.twitter.com/1.1/statuses/user_timeline.json'");

it('has the correct endpoint value', function (): void {
	expect(UserTimelineEndpoint::make()->endpoint)
		->toBeString()
		->toEqual('1.1/statuses/user_timeline.json');
});

it('constructs the correct url with `url()`', function (): void {
	$full_url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

	expect(UserTimelineEndpoint::make()->url())
		->toBeString()
		->toEqual($full_url);
});
