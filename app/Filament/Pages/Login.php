<?php

namespace App\Filament\Pages;

use App\Features\AdminLogin;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login as BaseLoginPage;
use Laravel\Pennant\Feature;

class Login extends BaseLoginPage
{
    public function authenticate(): LoginResponse|null
	{
		if (Feature::inactive(AdminLogin::class)) {
			Notification::make()
				->title(__('Login Disabled'))
				->body(__('Login is disabled right now. Please come back later.'))
				->danger()
				->send();

			return null;
		}

		return parent::authenticate();
	}
}
