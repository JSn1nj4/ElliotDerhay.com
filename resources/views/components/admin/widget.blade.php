<x-column class="block bg-gray-200 dark:bg-gray-800 dark:hover:bg-sea-green-200/20 p-6 rounded-xl border border-gray-500 hover:border-gray-800 dark:border-gray-700/30 dark:hover:border-sea-green-200 transition-colors duration-300">
	<div class="block md:flex">
		<h3 class="text-2xl uppercase">{{ $title }}</h3>
	</div>
	<div>
		{{ $slot }}
	</div>
</x-column>
