<?php

namespace App\DataTransferObjects;

use App\Factories\TwitterUserValidatorFactory;
use Spatie\DataTransferObject\DataTransferObject;

class TwitterUserDTO extends DataTransferObject
{
	public int $id;

	public string $name;

	public string $screen_name;

	public string $profile_image_url_https;

	public static function fromArray(array $userData): self
	{
		TwitterUserValidatorFactory::make($userData)->validate();

		return new self(
			id: $userData['id'],
			name: $userData['name'],
			screen_name: $userData['screen_name'],
			profile_image_url_https: $userData['profile_image_url_https'],
		);
	}
}
