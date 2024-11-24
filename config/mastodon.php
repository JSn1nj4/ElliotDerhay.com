<?php

return [
	'client' => [
		// e.g. My Mastodon Client
		'name' => env('MASTODON_CLIENT_NAME'),
		// e.g. example.com
		'domain' => env('MASTODON_CLIENT_DOMAIN'),
		// used to request oauth token
		'secret' => env('MASTODON_CLIENT_SECRET'),
	],
	'instance' => [
		'domain' => env('MASTODON_DOMAIN'),
	],
];
