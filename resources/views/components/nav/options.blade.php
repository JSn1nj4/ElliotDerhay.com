<div class="block" id="theme-toggle-wrapper">
	<button
		class="system-button justify-items-start place-items-center gap-2 text-left text-black dark:text-white transition-colors duration-300"
		onclick="toLightMode()" title="Switch to light theme">
		<svg xmlns="http://www.w3.org/2000/svg"
				 class="system-icon h-8 w-8 text-bright-turquoise-800 dark:text-bright-turquoise-500 hover:text-neutral-700 dark:hover:text-white"
				 fill="none" viewBox="0 0 24 24"
				 stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
						d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
		</svg>
		System Theme
	</button>

	<button
		class="light-mode-button justify-items-start place-items-center gap-2 text-left text-black dark:text-white transition-colors duration-300"
		onclick="toDarkMode()" title="Switch to dark theme">
		<svg xmlns="http://www.w3.org/2000/svg"
				 class="light-mode-icon h-8 w-8 text-bright-turquoise-800 dark:text-bright-turquoise-500 hover:text-neutral-700 dark:hover:text-white"
				 fill="none" viewBox="0 0 24 24"
				 stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
						d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
		</svg>
		Light Theme
	</button>

	<button
		class="dark-mode-button justify-items-start place-items-center gap-2 text-left text-black dark:text-white transition-colors duration-300"
		onclick="toSystemMode()" title="Switch to fun theme">
		<svg xmlns="http://www.w3.org/2000/svg"
				 class="dark-mode-icon h-8 w-8 text-bright-turquoise-800 dark:text-bright-turquoise-500 hover:text-neutral-700 dark:hover:text-white"
				 fill="none" viewBox="0 0 24 24"
				 stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
						d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
		</svg>
		Dark Theme
	</button>
</div>

<div id="fun-theme-wrapper" class='hidden dark:block'>
	<button
		class="fun-mode-button justify-items-start place-items-center gap-2 text-left text-bright-turquoise-800 dark:text-bright-turquoise-500  hover:text-neutral-700 dark:hover:text-white transition-colors duration-300"
		onclick="toggleFunMode()" title="Enable Fun theme">
		<svg class='fun-mode-icon size-8 fill-current'
				 xmlns="http://www.w3.org/2000/svg"
				 viewBox="0 0 400 580">
			<!--! Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2024 Fonticons, Inc. -->
			<path
				d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288l111.5 0L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7l-111.5 0L349.4 44.6z" />
		</svg>
		Fun Mode
	</button>
</div>
