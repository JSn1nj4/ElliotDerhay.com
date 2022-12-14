<?php

use App\Enums\HttpMethod;
use App\Services\Github\Endpoints\BaseEndpoint;

it('creates an instance of App\Services\Github\Endpoints\BaseEndpoint', function (): void {
	expect(new BaseEndpoint)->toBeInstanceOf(BaseEndpoint::class);
});

it('creates an instance using `make()` method', function (): void {
	expect(BaseEndpoint::make())->toBeInstanceOf(BaseEndpoint::class);
});

it('has the correct endpoint base', function (): void {
	$baseEndpoint = new BaseEndpoint;

	expect($baseEndpoint->base)
		->toBeString()
		->toEqual("https://api.github.com");
});

it('throws an error when accessing uninitialized property BaseEndpoint::$endpoint', function (): void {
	BaseEndpoint::make()->endpoint;
})->throws(Error::class, "Typed property App\Services\AbstractEndpoint::\$endpoint must not be accessed before initialization");

it('expects BaseEndpoint::$method to default to App\Definitions\HttpMethod::GET', function (): void {
	expect(BaseEndpoint::make()->method)
		->toBeInstanceOf(HttpMethod::class)
		->toEqual(HttpMethod::GET);
});

it('expects $headers to be an empty array', function (): void {
	expect(BaseEndpoint::make()->headers)
		->toBeArray()
		->toHaveLength(0);
});

it('expects $params to be an empty array', function (): void {
	expect(BaseEndpoint::make()->params)
		->toBeArray()
		->toHaveLength(0);
});

it('throws an error when calling `url()` directly on BaseEndpoint', function (): void {
	BaseEndpoint::make()->url();
})->throws(Error::class, "Typed property App\Services\AbstractEndpoint::\$endpoint must not be accessed before initialization");
