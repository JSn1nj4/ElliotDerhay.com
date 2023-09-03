<?php

namespace App\Contracts\States;

interface PostStateContract
{
	public function publish(): bool;

	public function unpublish(): bool;
}
