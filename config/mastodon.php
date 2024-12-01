<?php

return [
	'client' => [
		// e.g. My Mastodon Client
		'name' => env('MASTODON_CLIENT_NAME'),
		// e.g. example.com
		'domain' => env('MASTODON_CLIENT_DOMAIN'),
		'redirect_uris' => env('MASTODON_CLIENT_REDIRECT_URIS'),
		// used to request oauth token
		'id' => env('MASTODON_CLIENT_ID'),
		'secret' => env('MASTODON_CLIENT_SECRET'),
		// used to init client
		'scopes' => env('MASTODON_CLIENT_SCOPES'),
		'website' => env('MASTODON_CLIENT_WEBSITE'),
	],
	'instance' => [
		'domain' => env('MASTODON_DOMAIN'),
	],
];
