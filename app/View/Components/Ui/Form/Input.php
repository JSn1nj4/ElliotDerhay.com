<?php

namespace App\View\Components\Ui\Form;

use App\View\Components\Ui\Enums\TextInputType;
use Illuminate\View\Component;

class Input extends Component
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
		public string $padding = 'p-2',
		public string $textSize = 'text-lg',
		public TextInputType $type = TextInputType::Text,
		public ?string $value = null,
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
        return view('components.ui.form.input');
    }
}
