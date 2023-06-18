<form wire:submit.prevent="submit">
	<div class="flex relative gap-0 overflow-clip">
		<input class="flex-grow pr-2 bg-transparent text-black dark:text-white p-4 outline-none" type="text" placeholder="{{ $field }}" wire:model="value">
		<button class="p-2 bg-seaGreen-800 dark:bg-seaGreen-600 text-white dark:text-black text-xl bold" type="submit">{{ $button }}</button>
	</div>
</form>
