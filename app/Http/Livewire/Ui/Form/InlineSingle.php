<?php

namespace App\Http\Livewire\Ui\Form;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class InlineSingle extends Component
{
	public string $button;

	public string $field;

	public string $submitEvent;

	public string $value;

    public function render(): View
    {
        return view('livewire.ui.form.inline-single');
    }

	public function submit(): void
	{
		$this->emit($this->submitEvent, $this->value);
	}
}
