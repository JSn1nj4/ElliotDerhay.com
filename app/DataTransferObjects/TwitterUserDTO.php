<?php

namespace App\DataTransferObjects;

class TwitterUserDTO
{
	public function __construct(
		public readonly int $id,
		public readonly string $name,
		public readonly string $screen_name,
		public readonly string $profile_image_url_https,
	) {}

	public static function fromArray(array $userData): self
	{
		return new self(
			id: $userData['id'],
			name: $userData['name'],
			screen_name: $userData['screen_name'],
			profile_image_url_https: $userData['profile_image_url_https'],
		);
	}
}
