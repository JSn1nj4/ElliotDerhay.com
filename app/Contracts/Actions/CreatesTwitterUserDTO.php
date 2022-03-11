<?php

namespace App\Contracts\Actions;

use App\DataTransferObjects\TwitterUserDTO;

interface CreatesTwitterUserDTO
{
	public function __invoke(array $data): TwitterUserDTO;
}
