<?php

namespace App\Filament\Pages;

use App\Features\AdminLogin;
use App\Jobs\LoginFailed;
use App\Jobs\LoginSucceeded;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login as BaseLoginPage;
use Illuminate\Support\Facades\Request;
use Laravel\Pennant\Feature;

class Login extends BaseLoginPage
{
	public function authenticate(): LoginResponse|null
	{
		try {
			if (Feature::inactive(AdminLogin::class)) {
				Notification::make()
					->title(__('Login Disabled'))
					->body(__('Login is disabled right now. Please come back later.'))
					->danger()
					->send();

				return null;
			}

			$response = parent::authenticate();

			if ($response instanceof LoginResponse) {
				LoginSucceeded::dispatch(
					$this->getCredentialsFromFormData($this->form->getState())['email'],
					Request::ip(),
				);
			} else {
				LoginFailed::dispatch(
					$this->getCredentialsFromFormData($this->form->getState())['email'],
					'reason unknown',
					Request::ip(),
				);
			}

			return $response;
		} catch (\Throwable $exception) {
			LoginFailed::dispatch(
				$this->getCredentialsFromFormData($this->form->getState())['email'],
				$exception->getMessage(),
				Request::ip(),
			);

			throw $exception;
		}
	}
}
