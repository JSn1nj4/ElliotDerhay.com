<?php

namespace App\View\Components\Ui\Form;

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
		public string $height = 'h-64',
		public string $padding = 'p-2',
		public string $textSize = 'text-lg',
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
