<?php

namespace App\Filament\Resources;

use App\Actions\StoresImage;
use App\Filament\Forms\Components\ImageViewField;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Image;
use App\Models\Post;
use App\Support\Sanitizer;
use Filament\Forms;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Collection;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PostResource extends Resource
{
    protected static string|null $model = Post::class;

    protected static string|null $navigationIcon = 'm-document-text';

	protected static string|null $navigationGroup = 'Content';

	public int|null $image_id = null;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
			->columns(3)
            ->schema([
				Forms\Components\Section::make('Content')
					->columnSpan(2)
					->schema([
						Forms\Components\TextInput::make('title')
							->required()
							->maxLength(180)
							->reactive()
							->debounce(500)
							->afterStateUpdated(static function (Forms\Get $get, Forms\Set $set, string|null $state) {
								$slug = str($get('slug'))->trim();

								if (!in_array($slug, [null, ''])) return;

								$set('slug', Sanitizer::slug($state)->toString());
							})
							->columnSpanFull(),

						Forms\Components\TextInput::make('slug')
							->required()
							->unique(ignoreRecord: true)
							->maxLength(180)
							->alphaDash()
							->reactive()
							->debounce(500)
							->afterStateUpdated(static function (Forms\Get $get, Forms\Set $set, string|null $state) {
								$set('slug', Sanitizer::slug(match(trim($state)) {
									null, '' => $get('title'),
									default => $state
								})->toString());
							})
							->columnSpanFull(),
						Forms\Components\MarkdownEditor::make('body')
							// TODO: Implement native file uploads using separate image collection - 'content' instead of 'images'?
							->toolbarButtons([
								'bold',
								'italic',
								'strike',
								'link',
								'heading',
								'blockquote',
								'codeBlock',
								'bulletList',
								'orderedList',
								'table',
								'undo',
								'redo',
							])
							->required()
							->columnSpanFull(),
					]),

				Forms\Components\Group::make([
					Forms\Components\Section::make('Image')
						->schema([
							ImageViewField::make('image')
								->hiddenLabel()
								->hiddenOn('create')
								->visible(static fn (Image $image) => $image->exists()),

							Forms\Components\FileUpload::make('upload')
								->hiddenLabel()
								->image()
								->maxSize(5 * 1024)
								->afterStateUpdated(static function (Forms\Set $set, TemporaryUploadedFile $state) {
									$image = StoresImage::execute($state);

									$set('image_id', $image->id);
								})
								->reactive(),

							Forms\Components\Hidden::make('image_id'),
						])
						->saveRelationshipsUsing(static function (Post $post, Forms\Get $get) {
							$image_id = $get('image_id');

							if ($image_id === null) return;

							if (Image::whereId($image_id)->doesntExist()) return;

							$post->images()->sync([$image_id]);
						}),

					Forms\Components\Section::make('Meta')
						->relationship('searchMeta')
						->schema([
							Forms\Components\TextInput::make('search_title')
								->label('Custom Search Title')
								->maxLength('180'),

							Forms\Components\Textarea::make('search_description')
								->label('Custom Search Description')
								->maxLength('250'),
						]),

					Forms\Components\Section::make('Taxonomies')
						->schema([
							Forms\Components\Select::make('categories')
								->relationship('categories', 'title')
								->multiple()
								->createOptionForm([
									Forms\Components\TextInput::make('title')
										->live(debounce: 500)
										->alphaNum()
										->maxLength(255)
										->afterStateUpdated(static function (Forms\Set $set, $state) {
											if ($state === null || strlen($state) === 0) return;

											$set('slug', Sanitizer::slug($state)->toString());
										}),
									Forms\Components\Hidden::make('slug'),
								]),

							Forms\Components\Select::make('tags')
								->relationship('tags', 'title')
								->multiple()
								->createOptionForm([
									Forms\Components\TextInput::make('title')
										->live(debounce: 500)
										->alphaNum()
										->maxLength(255)
										->afterStateUpdated(static function (Forms\Set $set, $state) {
											if ($state === null || strlen($state) === 0) return;

											$set('slug', Sanitizer::slug($state)->toString());
										}),
									Forms\Components\Hidden::make('slug'),
								]),
						]),
				])
				->columnSpan(1),
            ]);
    }

	public static function infolist(Infolists\Infolist $infolist): Infolists\Infolist
	{
		return $infolist
			->columns(3)
			->schema([
				Infolists\Components\Section::make('content')
					->schema([
							Infolists\Components\TextEntry::make('title')
								->hiddenLabel()
								->size(Infolists\Components\TextEntry\TextEntrySize::Large),

							Infolists\Components\TextEntry::make('body')
								->markdown(),
					])
					->columnSpan(2),

				Infolists\Components\Section::make('meta')
					->schema([
						Infolists\Components\ImageEntry::make('image.url')
							->hiddenLabel()
							->hidden(static fn (string|null $state) => $state === null)
							->size('100%'),

						Infolists\Components\RepeatableEntry::make('tags')
							->hidden(static fn (Collection $state) => $state->isEmpty())
							->schema([
								Infolists\Components\TextEntry::make('title')
									->hiddenLabel(),
							]),
					])
					->columnSpan(1),
			]);
	}

	public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
				Tables\Columns\ImageColumn::make('image.url')
					->disk(static fn (Image $image) => $image->disk)
					->size('auto')->height(135),
				Tables\Columns\TextColumn::make('title')
					->sortable(),
				Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
			->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
				Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
