<?php

namespace App\Filament\Resources\Images;

use App\Filament\Forms\Components\ImageViewField;
use App\Filament\Resources\Images\Pages\EditImage;
use App\Filament\Resources\Images\Pages\ListImages;
use App\Filament\Resources\Images\Pages\UploadImage;
use App\Filament\Resources\Images\Pages\ViewImage;
use App\Filament\Traits\HasCountBadge;
use App\Models\Image;
use App\Services\ImageService;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImageResource extends Resource
{
	use HasCountBadge;

	protected static string|null $model = Image::class;

	protected static string|\BackedEnum|null $navigationIcon = 'm-photo';

	protected static int|null $navigationSort = 3;

	protected static string|\UnitEnum|null $navigationGroup = 'Content';

	protected static string|null $navigationLabel = 'Image Gallery';

	protected static string|null $recordTitleAttribute = 'name';

	public array|null $image = [];
	public string|null $name = null;

	public static function form(Schema $schema): Schema
	{
		return $schema
			->columns(1)
			->components([
				Group::make([
					Section::make('Preview')
						->columnSpan(1)
						->schema([
							ImageViewField::make('image')
								->dehydrated(false)
								->hiddenLabel(),

							TextInput::make('markdown_link')
								->disabled()
								->copyable()
								->formatStateUsing(static function (Image|null $record) {
									if ($record === null) return '';

									return "![](" . ImageService::make()
											->url($record->path, $record->disk) . ")";
								})
								->suffixIconColor('#06c6b1')
								->label('Markdown Link'),
						]),

					Section::make('Info')
						->columnSpan(2)
						->columns(3)
						->schema([
							TextInput::make('name')
								->columnSpan(2)
								->required()
								->maxLength(255),

							TextInput::make('file_name')
								->columnSpan(1)
								->disabled(),

							Textarea::make('caption')
								->columnSpanFull()
								->maxLength(255),

							TextInput::make('collection')
								->disabled(),

							TextInput::make('mime_type')
								->disabled(),

							TextInput::make('size')
								->numeric()
								->disabled(),

							TextInput::make('disk')
								->disabled(),

							TextInput::make('path')
								->columnSpan(2)
								->disabled(),

							Hidden::make('file_hash')
								->unique(ignoreRecord: true)
								->disabled(),
						]),
				])
					->columns(3),
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->defaultSort('created_at', 'desc')
			->columns([
				ImageColumn::make('url')
					->disk(static fn (Image $image) => $image->disk)
					->size('auto')->height(135)
					->label('Preview'),
				TextColumn::make('name')
					->searchable(),
				TextColumn::make('file_name')
					->searchable()
					->toggleable()
					->label('Filename'),
				TextColumn::make('mime_type')
					->toggleable(isToggledHiddenByDefault: true)
					->label('File type'),
				TextColumn::make('disk')
					->toggleable(),
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
				DeleteBulkAction::make(),
			]);
	}

	public static function getRelations(): array
	{
		return [
			//
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => ListImages::route('/'),
			'create' => UploadImage::route('/create'),
			'view' => ViewImage::route('/{record}'),
			'edit' => EditImage::route('/{record}/edit'),
		];
	}
}
