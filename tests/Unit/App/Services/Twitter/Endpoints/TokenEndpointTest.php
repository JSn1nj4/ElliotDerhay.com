<?php

use App\Enums\HttpMethod;
use App\Services\Twitter\Endpoints\TokenEndpoint;

it('creates an instance of App\Services\Twitter\Endpoints\TokenEndpoint', function (): void {
	expect(new TokenEndpoint)->toBeInstanceOf(TokenEndpoint::class);
});

it('sets TokenEndpoint::$method to App\Definitions\HttpMethod::POST', function (): void {
	expect(TokenEndpoint::make()->method)
		->toBeInstanceOf(HttpMethod::class)
		->toEqual(HttpMethod::POST);
});

it('sets the \'Authorization\' header', function (): void {
	$test_authorization = 'test_authorization';
	$endpoint = TokenEndpoint::make()
		->with([
			'Authorization' => $test_authorization,
		]);

	expect($endpoint->headers['Authorization'])
		->toEqual($test_authorization);
});

it('throws an exception if \'Authorization\' header is not passed', function (): void {
	TokenEndpoint::make()->with([]);
})->throws(Exception::class, "Header 'Authorization' is required for endpoint 'https://api.twitter.com/oauth2/token'");

it('has the correct endpoint value', function (): void {
	expect(TokenEndpoint::make()->endpoint)
		->toBeString()
		->toEqual('oauth2/token');
});

it('constructs the correct url with `url()`', function (): void {
	$full_url = "https://api.twitter.com/oauth2/token";

	expect(TokenEndpoint::make()->url())
		->toBeString()
		->toEqual($full_url);
});
