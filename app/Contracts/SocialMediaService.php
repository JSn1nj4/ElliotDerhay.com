<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface SocialMediaService {
	public function getUrl(string $url): string;
	public function getPosts(string $username, ?string $since = null, bool $reposts = true, ?int $count = null): Collection;
}
