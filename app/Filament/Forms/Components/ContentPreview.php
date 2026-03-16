<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class ContentPreview extends Field
{
	protected string $view = 'filament.forms.components.content-preview';

	public function getContent(): string
	{
		return $this->getState();
	}
}
