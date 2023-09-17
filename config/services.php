<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Mailgun, Postmark, AWS and more. This file provides the de facto
	| location for this type of information, allowing packages to have
	| a conventional file to locate the various service credentials.
	|
	*/

	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
		'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
	],

	'postmark' => [
		'token' => env('POSTMARK_TOKEN'),
	],

	'ses' => [
		'key' => env('AWS_ACCESS_KEY_ID'),
		'secret' => env('AWS_SECRET_ACCESS_KEY'),
		'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
	],

	'twitter' => [
		'model' => \App\Models\Tweet::class,
		'key' => env('TWITTER_API_KEY'),
		'secret' => env('TWITTER_API_SECRET'),
		'token' => env('TWITTER_API_TOKEN'),
	],

	'github' => [
		'model' => \App\Models\GithubEvent::class,
		'token' => env('GITHUB_API_TOKEN'),
	],

	'x' => [
		'access_token' => env('X_ACCESS_TOKEN'),
		'access_token_secret' => env('X_ACCESS_TOKEN_SECRET'),
		'account_id' => (int)env('X_ACCOUNT_ID'),
		'api_key' => env('X_API_KEY'),
		'api_secret' => env('X_API_SECRET'),
		'bearer_token' => env('X_BEARER_TOKEN'),
		'client_id' => env('X_CLIENT_ID'),
		'client_secret' => env('X_CLIENT_SECRET'),
	],

];
