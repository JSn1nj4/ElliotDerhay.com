<?php

namespace App\Http\Livewire\Ui\Form;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class InlineSingle extends Component
{
	public string $button;

	public string $field;

	public string $submitEvent;
	public string $resetEvent;

	public string|null $value = null;

	protected $listeners = ['updated' => 'resetForm'];

	public function mount(): void
	{
		$this->resetEvent ??= 'updated';
	}

	protected function getListeners(): array
	{
		return [ $this->resetEvent => 'resetForm'];
	}

	public function resetForm(): void
	{
		$this->value = null;
	}

    public function render(): View
    {
        return view('livewire.ui.form.inline-single');
    }

	public function submit(): void
	{
		$this->emit($this->submitEvent, $this->value);
	}
}
