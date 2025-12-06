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
	<x-nav.select-item
		id='display_theme'
		name='display_theme'
		event-key='theme'
		dispatch='display_theme.update'
		listen='display_theme.updated'
	>
		<x-slot:label>Display Theme</x-slot:label>
		<option value='light'>Light Metallic</option>
		<option value='dark'>Cybernetic</option>
		<option value='dark2'>Industrial</option>
	</x-nav.select-item>
</div>
