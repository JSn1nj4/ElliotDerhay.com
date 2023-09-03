<?php

namespace App\Filament\Resources\CommandResource\Pages;

use App\Actions\LogCommandEvent;
use App\Filament\Resources\CommandResource;
use App\Models\Command;
use App\Support\Sanitizer;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\IconPosition;
use Illuminate\Support\Facades\Artisan;

class ViewCommand extends ViewRecord
{
    protected static string $resource = CommandResource::class;

	protected function commandFailed(string $title, string|null $body): void
	{
		$notification = Notification::make()
			->title($title);

		if ($body) $notification->body($body);

		$notification->danger()->send();
	}

	protected function commandSucceeded(string $title, string|null $body): void
	{
		$notification = Notification::make()
			->title($title);

		if ($body) $notification->body($body);

		$notification->success()->send();
	}

    protected function getActions(): array
    {
        return [
			Actions\Action::make('Run')
				->icon('o-command-line')
				->iconPosition(IconPosition::After)
				->color('warning')
				->requiresConfirmation()
				->outlined(true)
				->action(function (Command $record) {
					$signature = Sanitizer::sanitize($record->signature);

					if (!$record->exists()) {
						$this->commandFailed(
							'Command not found',
							sprintf('The command "%s" does not exist.', $signature),
						);

						return;
					}

					if (!in_array(Sanitizer::sanitize($record->signature), config('app.commands.whitelist'))) {
						$this->commandFailed(
							'Running command failed',
							sprintf('The command "%s" could not be run.', $signature),
						);

						LogCommandEvent::execute($record, false, 'Command not whitelisted.');

						return;
					}

					try {
						Artisan::call($signature);

						$this->commandSucceeded(
							'Command succeeded!',
							sprintf('The command "%s" was run successfully!', $signature),
						);
					} catch (\Exception $exception) {
						LogCommandEvent::execute($record, false, $exception->getMessage());

						$this->commandFailed(
							'Running command failed',
							sprintf('The command "%s" was unable to run.', $signature)
						);
					}
				}),

			Actions\EditAction::make()
				->icon('o-pencil-square')
				->iconPosition(IconPosition::After),
        ];
    }

	protected function getFooterWidgets(): array
	{
		return [
			CommandResource\Widgets\CommandLog::class,
		];
	}

	public function getFooterWidgetsColumns(): int|string|array
	{
		return [
			'md' => 1,
		];
	}
}
