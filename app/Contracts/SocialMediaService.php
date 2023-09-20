<?php

namespace App\Contracts;

use App\DataTransferObjects\OperationResult;
use App\DataTransferObjects\SocialPostDTO;
use Illuminate\Support\Collection;

interface SocialMediaService
{
	public function getPosts(string $username, string|null $since = null, bool $reposts = true, int|null $count = null): Collection;

	public function post(SocialPostDTO $postDTO): OperationResult;
}
