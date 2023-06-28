<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Image;
use App\Models\Project;
use App\View\Components\Column;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static string|null $model = Project::class;

    protected static string|null $navigationIcon = 'heroicon-o-code';

    public static function form(Form $form): Form
    {
        return $form->columns(3)
            ->schema([
				Forms\Components\Section::make('Info')
					->columnSpan(2)
					->schema([
						Forms\Components\TextInput::make('name')
							->required(),
						Forms\Components\Textarea::make('short_desc')
							->required(),
					]),
				Forms\Components\Section::make('Image')
					->columnSpan(1)
					->schema([
						Forms\Components\FileUpload::make('image'),
					]),
				Forms\Components\Section::make('Links')
					->columns()
					->schema([
						Forms\Components\TextInput::make('link')
							->label('Project')
							->required(),
						Forms\Components\TextInput::make('demo_link')
							->label('Demo'),
					]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
				Tables\Columns\ImageColumn::make('image')
					->disk(static fn (Image $image) => $image->disk),
                Tables\Columns\TextColumn::make('name'),
				Tables\Columns\TextColumn::make('link'),
				Tables\Columns\TextColumn::make('demo_link'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
