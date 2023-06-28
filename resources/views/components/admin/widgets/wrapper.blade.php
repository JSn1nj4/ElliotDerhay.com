<x-column class="block bg-neutral-200 dark:bg-neutral-800 dark:hover:bg-caribbeanGreen-200/20 p-6 rounded-xl border border-neutral-500 hover:border-neutral-800 dark:border-neutral-700/30 dark:hover:border-caribbeanGreen-200 transition-colors duration-300">
	@if(isset($header))
	<div class="block md:flex flex-row justify-between">
		{{ $header }}
	</div>
	@endif
	<div>
		{{ $slot }}
	</div>
</x-column>
