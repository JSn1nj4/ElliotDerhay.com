<?php

namespace App\Http\Livewire\Ui\Form;

use Livewire\Component;

class Checkbox extends Component
{
	public string $fieldId;
	public string $name;
	public string $value;
	public string $label;
	public bool $checked = false;

	public string|null $form = null;

	protected $listeners = ['updated' => '$refresh'];

    public function render()
    {
        return view('livewire.ui.form.checkbox');
    }
}
