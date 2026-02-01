<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Enums\PostStatus;
use App\Filament\Resources\Posts\PostResource;
use App\Filament\Resources\Posts\Traits\PreparesForValidation;
use App\Models\Post;
use Exception;
use Filament\Actions;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\IconPosition;
use Illuminate\Notifications\Action;

class EditPost extends EditRecord
{
	use PreparesForValidation;

	protected static string $resource = PostResource::class;

	protected function getHeaderActions(): array
	{
		return [
			Actions\Action::make('View Live')
				->visible(static fn (Post $record) => $record->status === PostStatus::Published)
				->color('info')
				->outlined()
				->icon('o-arrow-top-right-on-square')
				->iconPosition(IconPosition::After)
				->url(route('blog.show', ['post' => $this->getRecord()]))
				->openUrlInNewTab(),

			...$this->publishActions(),

			DeleteAction::make()
				->icon('o-trash')
				->iconPosition(IconPosition::After),
		];
	}

	protected function publishActions(): array
	{
		return [
			Actions\Action::make('Publish')
				->hidden(static fn (Post $record) => $record->status === PostStatus::Published)
				->color('warning')
				->icon('o-globe-alt')
				->iconPosition(IconPosition::After)
				->requiresConfirmation()
				->modalHeading("Publishing Post")
				->modalDescription("Are you sure you want to publish this?")
				->modalCancelActionLabel('No')
				->modalSubmitActionLabel('Yes')
				->action(static function (Post $record): void {
					try {
						$record->state()->publish();

						Notification::make()
							->title(__('Post published!'))
							->actions([
								\Filament\Actions\Action::make('View Live')
									->url(route('blog.show', ['post' => $record]))
									->openUrlInNewTab()
									->color('success'),
							])
							->success()
							->send();
					} catch (Exception $e) {
						Notification::make()
							->title($e->getMessage())
							->danger()
							->send();
					}
				}),

			Actions\Action::make('Unpublish')
				->visible(static fn (Post $record) => $record->status === PostStatus::Published)
				->outlined()
				->color('warning')
				->icon('o-lock-closed')
				->iconPosition(IconPosition::After)
				->requiresConfirmation()
				->modalHeading("Unpublishing Post")
				->modalDescription("Are you sure you want to convert this back to a draft?")
				->modalCancelActionLabel('No')
				->modalSubmitActionLabel('Yes')
				->action(static function (Post $record): void {
					try {
						$record->state()->draft();

						Notification::make()
							->title(__('Post unpublished!'))
							->success()
							->send();
					} catch (Exception $e) {
						Notification::make()
							->title($e->getMessage())
							->danger()
							->send();
					}
				}),
		];
	}

	protected function getFormActions(): array
	{
		[$save, $cancel] = parent::getFormActions();

		return [
			$save
				->icon('o-circle-stack')
				->iconPosition(IconPosition::After),

			$cancel
				->icon('o-arrow-uturn-left')
				->iconPosition(IconPosition::After),

			...$this->publishActions(),

			DeleteAction::make()
				->icon('o-trash')
				->iconPosition(IconPosition::After),
		];
	}
}
