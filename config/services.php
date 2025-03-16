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

	'postmark' => [
		'token' => env('POSTMARK_TOKEN'),
	],

	'ses' => [
		'key' => env('AWS_ACCESS_KEY_ID'),
		'secret' => env('AWS_SECRET_ACCESS_KEY'),
		'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
	],

	'slack' => [
		'notifications' => [
			'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
			'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
		],
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
		'username' => env('X_USERNAME'),
	],

];
