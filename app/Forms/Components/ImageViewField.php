<?php

namespace App\Forms\Components;

use App\Models\Image;
use Filament\Forms\Components\Field;
use Illuminate\Contracts\View\View;

class ImageViewField extends Field
{
    protected string $view = 'forms.components.image-view-field';

	protected Image $image;

	public function render(): View
	{
		$this->image = $this->getModelInstance()->image ?? Image::make();

		return parent::render();
	}

	public function getImage(): Image
	{
		return $this->image;
	}

	public function modelHasImage(): bool
	{
		return $this->image->exists;
	}
}
