<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GitHostService {
	public function getUrl(string $url): string;
	public function getEvents(string $user, int $count): Collection;
}
