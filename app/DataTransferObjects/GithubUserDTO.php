<?php

namespace App\DataTransferObjects;

class GithubUserDTO
{
	public function __construct(
		public readonly int $id,
		public readonly string $login,
		public readonly string $display_login,
		public readonly string $avatar_url,
	) {}

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
