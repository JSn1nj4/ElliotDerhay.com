<div class="block" id="theme-toggle-wrapper">
	<x-nav.select-item
		id='display_mode'
		name='display_mode'
		event-key='mode'
		dispatch='display_mode.update'
		listen='display_mode.updated'
	>
		<x-slot:label>Display Mode</x-slot:label>
		<option value='system'>System Default</option>
		<option value='light'>Light Mode</option>
		<option value='dark'>Dark Mode</option>
	</x-nav.select-item>
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
