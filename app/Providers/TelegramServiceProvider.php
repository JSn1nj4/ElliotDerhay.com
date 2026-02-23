<?php

namespace App\Providers;

use App\DataTransferObjects\TelegramRecipient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class TelegramServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		// this shouldn't be a singleton later if pulling telegram info from a user
		$this->app->singleton(TelegramRecipient::class, function () {
			$defaultName = config('services.telegram.default-recipient');

			$rules = ['handle' => [
				'required',
				Rule::anyOf([
					'regex:/^@[0-9a-z_]+/i',
					'integer',
				]),
			]];

			$errorMessages = [
				'handle' => 'Please set \'TELEGRAM_CHAT_ID\' in your environment to a valid Telegram chat ID. See Telegram\'s Bot API documentation for valid chat ID formats: https://core.telegram.org/api/bots/ids',
			];

			$defaultNameValidator = Validator::make(['handle' => $defaultName], $rules, $errorMessages);

			try {
				$validated = $defaultNameValidator->validate();

				return new TelegramRecipient($validated['handle']);
			} catch (ValidationException $exception) {
				$lastError = $exception;
			}

			$options = config('services.telegram.recipients');

			if (!isset($options[$defaultName])) throw $lastError;

			$default = $options[$defaultName];

			$defaultValidator = Validator::make(['handle' => $default], $rules, $errorMessages);

			$validated = $defaultValidator->validate();

			return new TelegramRecipient($validated['handle']);
		});
	}

	public function boot(): void {}
}
