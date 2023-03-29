<?php

use App\DataTransferObjects\GithubUserDTO;

it('creates a GithubUserDTO')
	->with('github_user_data_one')
	->expect(fn ($data) => new GithubUserDTO(
		$data['id'],
		$data['login'],
		$data['display_login'],
		$data['avatar_url'],
	))
	->toBeInstanceOf(GithubUserDTO::class);

it('creates a GithubUserDTO from array')
	->with('github_user_data_one')
	->expect(fn ($data) => GithubUserDTO::fromArray($data))
	->toBeInstanceOf(GithubUserDTO::class);
