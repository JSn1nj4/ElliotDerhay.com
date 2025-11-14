<nav class="flex items-center justify-between flex-wrap relative">

	<div class="flex items-center grow lg:shrink-0 text-white">
		<a href="/" class="text-black dark:text-white p-2">
			<img src="{{ asset_url("avatar-2026-crop.png") }}" width="60" height="60" alt="ElliotDerhay.com logo"
					 title="Elliot Derhay"
					 class="inline border-solid border border-black dark:border-white rounded-xl align-middle">
			<span class="text-xl sm:text-3xl tracking-tighter py-px2 pl-2 align-middle uppercase">
				{{ $title ?? "Elliot Derhay" }}
			</span>
		</a>
	</div>

	<div class='flex items-center gap-3'>
		<x-nav.dropdown mobile-condense>
			<x-slot:toggle>
				<input type="checkbox" id="menu-toggle" name="menu-toggle" class="hidden absolute top-0 left-0 -z-50">

				<label
					for="menu-toggle"
					class="flex items-center text-bright-turquoise-800 dark:text-bright-turquoise-500 hover:text-neutral-700 dark:hover:text-white transition-colors duration-300 peer-checked:text-neutral-700 dark:peer-checked:text-white">
					<x-fas-list-ul class='size-8' options='Menu' />
				</label>
			</x-slot:toggle>

			{{ $slot }}
		</x-nav.dropdown>

		<x-nav.dropdown>
			<x-slot:toggle>
				<input
					type='checkbox'
					name='options_toggle'
					id='options_toggle'
					class='absolute invisible -z-10 menu-toggle'
				>
				<label
					for='options_toggle'
					class="flex items-center text-bright-turquoise-800 dark:text-bright-turquoise-500 hover:text-neutral-700 dark:hover:text-white transition-colors duration-300 peer-checked:text-neutral-700 dark:peer-checked:text-white"
				>
					<x-fas-gear class='size-8' title='Options' />
				</label>
			</x-slot:toggle>

			<x-nav.options />
		</x-nav.dropdown>
	</div>

</nav>
