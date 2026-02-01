<?php

namespace App\Contracts\States;

use Carbon\Carbon;

interface PostStateContract
{
	public function draft(): bool;

	public function publish(): bool;

	public function schedule(Carbon|\DateTime|string $time): bool;
}
