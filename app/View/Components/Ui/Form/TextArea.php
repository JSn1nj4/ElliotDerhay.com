<?php

namespace App\View\Components\Ui\Form;

use App\Enums\TextAreaHeight;
use Illuminate\View\Component;

class TextArea extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
		public string $id,
		public string $name,
		public bool $error = false,
		public TextAreaHeight $height = TextAreaHeight::Medium, // todo: need height variations: h-32 = sm?, h-64 = mid, h-128 = lg?
		public string $padding = 'p-2',
		public string $textSize = 'text-lg',
		public string|null $form = null,
	)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.form.text-area');
    }
}
