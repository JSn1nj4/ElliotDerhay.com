<?php

use App\DataTransferObjects\TwitterUserDTO;

it('creates a TwitterUserDTO')
	->with('twitter_user')
	->expect(fn ($data) => new TwitterUserDTO(
		$data['id'],
		$data['name'],
		$data['screen_name'],
		$data['profile_image_url_https']
	))
	->toBeInstanceOf(TwitterUserDTO::class);

it('creates a TwitterUserDTO from array')
	->with('twitter_user')
	->expect(fn ($data) => TwitterUserDTO::fromArray($data))
	->toBeInstanceOf(TwitterUserDTO::class);
