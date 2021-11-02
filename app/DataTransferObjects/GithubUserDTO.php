<?php

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class GithubUserDTO extends DataTransferObject
{
	public int $id;

	public string $login;

	public string $display_login;

	public string $avatar_url;

	public static function fromArray(array $userData): self
	{
		return new self(
			id: $userData['id'],
			login: $userData['login'],
			display_login: $userData['display_login'],
			avatar_url: $userData['avatar_url'],
		);
	}
}
