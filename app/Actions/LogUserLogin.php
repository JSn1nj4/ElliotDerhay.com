<?php

namespace App\Actions;

use App\Models\Login;
use App\Models\User;

class LogUserLogin extends BaseAction
{
	public function __invoke(User $user): Login
	{
		return Login::create(['user_id' => $user->id]);
	}
}
