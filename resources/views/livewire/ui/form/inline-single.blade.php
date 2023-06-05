<form wire:submit.prevent="$emitUp('{{ $submitEvent }}')">
	<div class="flex relative gap-0 overflow-clip">
		<input class="flex-grow pr-2 bg-transparent text-black dark:text-white p-4 outline-none" type="text" placeholder="{{ $field }}">
		<button class="p-2 bg-sea-green-800 dark:bg-sea-green-600 text-white dark:text-black text-xl bold" type="submit">{{ $button }}</button>
	</div>
</form>
