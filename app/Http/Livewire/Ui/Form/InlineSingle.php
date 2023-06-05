<?php

namespace App\Http\Livewire\Ui\Form;

use Livewire\Component;

class InlineSingle extends Component
{
	public string $button;

	public string $field;

	public string $submitEvent;

    public function render()
    {
        return view('livewire.ui.form.inline-single');
    }
}
