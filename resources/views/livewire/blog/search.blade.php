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
					 class='flex-grow bg-white dark:bg-neutral-950 border -margin-r-px border-slate-600 dark:hover:border-bright-turquoise-400 rounded-t xl:rounded-tr-none xl:rounded-l p-2 text-lg'>
		<button type='submit'
						class='w-full xl:w-auto border-x border-b xl:border-t xl:border-l-0 bg-white dark:bg-neutral-950 transition-colors border-slate-600 dark:hover:border-bright-turquoise-400 dark:active:border-white rounded-b xl:rounded-r xl:rounded-bl-none px-4 py-2 text-md uppercase text-bright-turquoise-800 hover:text-bright-turquoise-400 dark:text-bright-turquoise-400 dark:hover:text-bright-turquoise-50'
						title='Submit Search'>
			<x-fas-search
				class='w-auto h-[1em] inline align-middle' />
			<span class='xl:hidden'>Search</span>
		</button>
	</form>
</x-widget.wrapper>
