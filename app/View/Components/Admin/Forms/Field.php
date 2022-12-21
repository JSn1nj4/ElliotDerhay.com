<?php

namespace App\View\Components\Admin\Forms;

use Illuminate\View\Component;

class Field extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
		public string $label,
		public string $field,
		public string $value,
		public object $errors,
		public bool $large = false,
		public bool $multiline = false,
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
        return view('components.admin.forms.field');
    }
}
