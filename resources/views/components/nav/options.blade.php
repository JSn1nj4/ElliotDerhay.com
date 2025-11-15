<div class="block" id="theme-toggle-wrapper">
	<x-nav.button-item
		class='system-button'
		onclick='toLightMode()'
		text='System Theme'
		button-text="Switch to Light Mode"
	>
		<x-slot:icon>
			<x-icons.system />
		</x-slot:icon>
	</x-nav.button-item>

	<x-nav.button-item
		class='light-mode-button'
		onclick='toDarkMode()'
		text='Light Theme'
		button-text="Switch to Dark Mode"
	>
		<x-slot:icon>
			<x-icons.light />
		</x-slot:icon>
	</x-nav.button-item>

	<x-nav.button-item
		class='dark-mode-button'
		onclick='toSystemMode()'
		text='Dark Theme'
		button-text='Switch to System Theme'
	>
		<x-slot:icon>
			<x-icons.dark />
		</x-slot:icon>
	</x-nav.button-item>
</div>

<div id="fun-theme-wrapper" class='hidden dark:block'>
	<x-nav.button-item
		class="fun-mode-button"
		onclick="toggleFunTheme()"
		text='Fun Mode'
		button-text="Toggle Fun Mode"
	>
		<x-slot:icon>
			<x-icons.bolt />
		</x-slot:icon>
	</x-nav.button-item>
</div>
