<?php

namespace App\Filament\Resources\Posts;

use App\Actions\StoresImage;
use App\Filament\Forms\Components\ImageViewField;
use App\Filament\Resources\CategoryResource\RelationManagers as CategoryRelationManagers;
use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\TagResource\RelationManagers as TagRelationManagers;
use App\Models\Image;
use App\Models\Post;
use App\Models\Scopes\PostPublishedScope;
use App\Support\Sanitizer;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Override;

class PostResource extends Resource
{
	protected static string|null $model = Post::class;

	protected static string|\BackedEnum|null $navigationIcon = 'm-document-text';

	protected static string|\UnitEnum|null $navigationGroup = 'Content';

	protected static int|null $navigationSort = 1;

	protected static string|null $recordTitleAttribute = 'title';

	public int|null $image_id = null;

	public static function form(Schema $schema): Schema
	{
		return $schema
			->columns(3)
			->components([
				Section::make('Content')
					->columnSpan(2)
					->schema([
						TextInput::make('title')
							->required()
							->maxLength(180)
							->live(500)
							->afterStateUpdated(static function (Get $get, Set $set, string|null $state) {
								$slug = str($get('slug'))->trim();

								if (!in_array($slug, [null, ''])) return;

								$set('slug', Sanitizer::slug($state)->toString());
							})
							->columnSpanFull(),

						TextInput::make('slug')
							->required()
							->unique(ignoreRecord: true)
							->maxLength(180)
							->alphaDash()
							->live(500)
							->afterStateUpdated(static function (Get $get, Set $set, string|null $state) {
								$set('slug', Sanitizer::slug(match (trim($state)) {
									null, '' => $get('title'),
									default => $state
								})->toString());
							})
							->columnSpanFull(),
						MarkdownEditor::make('body')
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

				Group::make([
					Section::make('Image')
						->schema([
							ImageViewField::make('image')
								->hiddenLabel()
								->hiddenOn('create')
								->visible(static fn (Image $image) => $image->exists()),

							FileUpload::make('upload')
								->hiddenLabel()
								->image()
								->maxSize(5 * 1024)
								->afterStateUpdated(static function (Set $set, TemporaryUploadedFile $state) {
									$image = StoresImage::execute($state);

									$set('image_id', $image->id);
								})
								->reactive(),

							Hidden::make('image_id'),
						])
						->saveRelationshipsUsing(static function (Post $post, Get $get) {
							$image_id = $get('image_id');

							if ($image_id === null) return;

							if (Image::whereId($image_id)->doesntExist()) return;

							$post->images()->sync([$image_id]);
						}),

					Section::make('Meta')
						->collapsed(static fn (array $state) => collect($state)
							->filter(static fn ($item, $key) => match ($key) {
								'search_title', 'search_description' => true,
								default => false,
							})
							->whereNotNull()
							->isEmpty())
						->relationship('searchMeta')
						->schema([
							TextInput::make('search_title')
								->string()
								->maxLength('180')
								->mutateDehydratedStateUsing(static fn (string|null $state) => self::sanitize($state))
								->label('Custom Search Title'),

							Textarea::make('search_description')
								->string()
								->maxLength('250')
								->mutateDehydratedStateUsing(static fn (string|null $state) => self::sanitize($state))
								->label('Custom Search Description'),
						]),

					Section::make('Taxonomies')
						->collapsed(static fn ($state) => empty([
							...$state['categories'],
							...$state['tags']
						]))
						->schema([
							Select::make('categories')
								->relationship('categories', 'title')
								->multiple()
								->createOptionForm([
									TextInput::make('title')
										->live(debounce: 500)
										->string()
										->maxLength(255)
										->afterStateUpdated(static function (Set $set, $state) {
											if ($state === null || strlen($state) === 0) return;

											$set('slug', Sanitizer::slug($state)->toString());
										})
										->mutateDehydratedStateUsing(static fn (string|null $state) => self::sanitize($state)),
									Hidden::make('slug')
										->alphaDash()
										->mutateDehydratedStateUsing(static fn (string|null $state) => self::sanitizeSlug($state)),
								])
								->hiddenOn([
									CategoryRelationManagers\PostsRelationManager::class,
								]),

							Select::make('tags')
								->relationship('tags', 'title')
								->multiple()
								->createOptionForm([
									TextInput::make('title')
										->live(debounce: 500)
										->string()
										->maxLength(255)
										->afterStateUpdated(static function (Set $set, $state) {
											if ($state === null || strlen($state) === 0) return;

											$set('slug', Sanitizer::slug($state)->toString());
										})
										->mutateDehydratedStateUsing(static fn (string|null $state) => self::sanitize($state)),
									Hidden::make('slug')
										->alphaDash()
										->mutateDehydratedStateUsing(static fn (string|null $state) => self::sanitizeSlug($state)),
								])
								->hiddenOn([
									TagRelationManagers\PostsRelationManager::class,
								]),
						]),
				])
					->columnSpan(1),
			]);
	}

	public static function getEloquentQuery(): Builder
	{
		return parent::getEloquentQuery()->withoutGlobalScope(PostPublishedScope::class);
	}

	#[Override]
	public static function getNavigationBadge(): string|null
	{
		return self::getModel()::withoutGlobalScope(PostPublishedScope::class)->count();
	}

	public static function infolist(Schema $schema): Schema
	{
		return $schema
			->columns(3)
			->components([
				Section::make('content')
					->schema([
						TextEntry::make('title')
							->hiddenLabel()
							->size(TextSize::Large),

						TextEntry::make('body')
							->markdown(),
					])
					->columnSpan(2),

				Section::make('meta')
					->schema([
						ImageEntry::make('image.url')
							->hiddenLabel()
							->hidden(static fn (string|null $state) => $state === null)
							->size('100%'),

						RepeatableEntry::make('categories')
							->hidden(static fn (Collection|null $state) => match ($state) {
								null => true,
								default => $state->isEmpty(),
							})
							->schema([
								TextEntry::make('title')
									->hiddenLabel(),
							]),

						RepeatableEntry::make('tags')
							->hidden(static fn (Collection|null $state) => match ($state) {
								null => true,
								default => $state->isEmpty(),
							})
							->schema([
								TextEntry::make('title')
									->hiddenLabel(),
							]),
					])
					->columnSpan(1),
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->defaultSort('posts.created_at', 'desc')
			->columns([
				ImageColumn::make('image.url')
					->disk(static fn (Image $image) => $image->disk)
					->size('auto')->height(135),
				TextColumn::make('title')
					->wrap(true)
					->searchable()
					->sortable(),
				TextColumn::make('slug')
					->toggleable(isToggledHiddenByDefault: true)
					->limit('30')
					->searchable(),
				TextColumn::make('published')
					->formatStateUsing(static fn (bool $state) => $state ? 'Published' : 'Draft')
					->badge()
					->colors([
						'success' => true,
						'gray' => false,
					])
					->icons([
						'o-check-badge' => true,
						'o-pencil-square' => false,
					])
					->iconPosition('after')
					->label('Status'),
				TextColumn::make('published_at')
					->dateTime('M d, Y | H:i')
					->sortable()
					->toggleable(),
				TextColumn::make('updated_at')
					->dateTime('M d, Y | H:i')
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
			])
			->filters([
				//
			])
			->recordActions([
				ViewAction::make(),
				EditAction::make(),
				DeleteAction::make(),
			])
			->toolbarActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
				]),
			])
			->emptyStateActions([
				CreateAction::make(),
			]);
	}

	public static function getPages(): array
	{
		return [
			'index' => ListPosts::route('/'),
			'create' => CreatePost::route('/create'),
			'edit' => EditPost::route('/{record}/edit'),
		];
	}

	public static function sanitize(string|null $state): string|null
	{
		return match ($state) {
			null => $state,
			default => Sanitizer::sanitize($state),
		};
	}

	public static function sanitizeSlug(string|null $state): string|null
	{
		return match ($state) {
			null => $state,
			default => Sanitizer::slug($state),
		};
	}
}
