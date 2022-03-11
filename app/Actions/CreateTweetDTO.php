<?php

namespace App\Actions;

use App\DataTransferObjects\TweetDTO;
use App\Factories\TweetValidatorFactory;

class CreateTweetDTO
{
	public function __construct()
	{

	}

	/**
	 * @throws \Illuminate\Validation\ValidationException
	 * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
	 */
	public function __invoke(array $data): TweetDTO
	{
		TweetValidatorFactory::make($data)->validate();

		return TweetDTO::fromArray($data);
	}
}
