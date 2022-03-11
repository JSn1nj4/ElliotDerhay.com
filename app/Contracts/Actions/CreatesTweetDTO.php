<?php

namespace App\Contracts\Actions;

use App\DataTransferObjects\TweetDTO;

interface CreatesTweetDTO
{
	public function __invoke(array $data): TweetDTO;
}
