<?php

namespace App\Actions;

use App\DataTransferObjects\TwitterUserDTO;
use App\Factories\TwitterUserValidatorFactory;

class CreateTwitterUserDTO
{
	public function __construct()
	{

	}

	/**
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function __invoke(array $data): TwitterUserDTO
	{
		TwitterUserValidatorFactory::make($data)->validate();

		return TwitterUserDTO::fromArray($data);
	}
}
