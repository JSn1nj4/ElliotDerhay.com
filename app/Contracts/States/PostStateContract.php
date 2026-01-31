<?php

namespace App\Contracts\States;

interface PostStateContract
{
	public function draft(): bool;

	public function publish(): bool;

	public function schedule(): bool;
}
