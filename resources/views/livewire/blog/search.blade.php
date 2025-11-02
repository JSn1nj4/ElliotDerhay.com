<?php

use Livewire\Attributes\Url;
use Livewire\Volt\Component;

new class extends Component {
	public string|null $search = null;

	public function send(): void
	{
		$this->dispatch('blog-search', search: $this->search);
	}
}; ?>

<x-widget.wrapper title=''>
	<form wire:submit="send" class='w-full flex flex-wrap'>
		<label for='search' class='w-full text-2xl'>Search</label>
		<input type='text' id='search' wire:model="search"
					 class='flex-grow border-y border-l border-bright-turquoise-600 rounded-l p-2 text-lg'>
		<button type='submit'
						class='border transition-colors border-bright-turquoise-600 dark:hover:border-slate-300 dark:active:border-white rounded-r px-4 py-2 text-md uppercase'
						title='Submit Search'>
			<x-fas-search class='w-auto h-[1em] inline align-middle stroke-white' />
		</button>
	</form>
</x-widget.wrapper>
