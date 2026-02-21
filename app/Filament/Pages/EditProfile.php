<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class EditProfile extends \Filament\Auth\Pages\EditProfile
{
	public function form(Schema $schema): Schema
	{
		$timezones = [];

		foreach (\DateTimeZone::listIdentifiers() as $value) {
			$timezones[$value] = $value;
		}

		return parent::form($schema)
			->components(array_merge($schema->getComponents(), [
				Select::make('timezone')
					->searchable()
					->options($timezones)
					->label('Preferred Timezone'),
			]));
	}
}
