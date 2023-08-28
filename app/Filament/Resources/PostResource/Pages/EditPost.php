<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Actions\PublishPost;
use App\Actions\UnpublishPost;
use App\Filament\Resources\PostResource;
use App\Models\Post;
use App\Support\Sanitizer;
use Filament\Actions;
use Filament\Notifications\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Notifications\Action;

class EditPost extends EditRecord
{
	use PostResource\Traits\PreparesForValidation;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
		return [
			...$this->publishActions(),
			Actions\DeleteAction::make(),
		];
    }

	protected function publishActions(): array
	{
		return [
			Actions\Action::make('Publish')
				->hidden(static fn (Post $record) => $record->published)
				->color('warning')
				->action(static function (Post $record): void {
					$result = PublishPost::execute($record);

					if ($result->succeeded) {
						Notification::make()
							->title(__('Post published!'))
							->actions([
								\Filament\Notifications\Actions\Action::make('View Live')
									->url(route('blog.show', ['post' => $record]))
									->openUrlInNewTab()
									->color('success'),
							])
							->success()
							->send();

						return;
					}

					Notification::make()
						->title(__('Post failed to publish.'))
						->danger()
						->send();
				}),
			Actions\Action::make('Unpublish')
				->visible(static fn (Post $record) => $record->published)
				->outlined()
				->color('warning')
				->action(static function (Post $record): void {
					$result = UnpublishPost::execute($record);

					if ($result->succeeded) {
						Notification::make()
							->title(__('Post unpublished!'))
							->success()
							->send();

						return;
					}

					Notification::make()
						->title(__('Post failed to unpublish.'))
						->danger()
						->send();
				}),
		];
	}

	protected function getFormActions(): array
	{
		return [
			...parent::getFormActions(),
			...$this->publishActions(),
			Actions\DeleteAction::make(),
		];
	}
}
