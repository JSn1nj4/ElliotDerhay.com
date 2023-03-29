<?php

namespace App\Actions;

use Illuminate\Support\Facades\Hash;

class HashPassword
{
	public function __invoke(string $password): string
	{
		return Hash::make($password);
	}
}
