<nav class="flex items-center justify-between flex-wrap bg-white dark:bg-black relative">

	<div class="flex items-center grow lg:shrink-0 text-white">
		<a href="/" class="text-black dark:text-white p-2">
			<img src="{{ asset_url("avatar.png") }}" width="60" height="60" alt="ElliotDerhay.com logo" title="Elliot Derhay"
					 class="inline border-solid border border-black dark:border-white rounded-xl align-middle">
			<span class="text-xl sm:text-3xl tracking-tighter py-px2 pl-2 align-middle uppercase">
				{{ $title ?? "Elliot Derhay" }}
			</span>
		</a>
	</div>

	<div class="block lg:hidden mr-4">
		<label for="menu-toggle"
					 class="flex items-center text-caribbean-green-900 dark:text-caribbean-green-500 hover:text-caribbean-green-600 dark:hover:text-white transition-colors duration-300">
			<svg class="fill-current h-8 w-8" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title>
				<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
			</svg>
		</label>
	</div>

	<input type="checkbox" id="menu-toggle" name="menu-toggle" class="hidden absolute top-0 left-0 -z-50">

	<div
		class="w-full block absolute lg:relative grow lg:flex lg:items-center lg:w-auto text-center lg:text-right text-xl mobile-menu">
		<div class="text-md lg:grow">

			{{ $slot }}

		</div>
	</div>

	<div class="block mr-3 border-l-2 border-solid border-caribbean-green-600 dark:border-caribbean-green-800 pl-3"
			 id="theme-toggle-button">
		<button
			class="flex items-center text-caribbean-green-800 dark:text-caribbean-green-500 hover:text-neutral-700 dark:hover:text-neutral-500 transition-colors duration-300"
			onclick="toDarkMode()" title="Switch to dark theme">
			<svg xmlns="http://www.w3.org/2000/svg" class="system-icon h-8 w-8" fill="none" viewBox="0 0 24 24"
					 stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
							d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
			</svg>
		</button>

		<button
			class="flex items-center text-caribbean-green-800 dark:text-caribbean-green-500 hover:text-neutral-700 dark:hover:text-neutral-500 transition-colors duration-300"
			onclick="toLightMode()" title="Switch to light theme">
			<svg xmlns="http://www.w3.org/2000/svg" class="dark-mode-icon h-8 w-8" fill="none" viewBox="0 0 24 24"
					 stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
							d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
			</svg>
		</button>

		<button
			class="flex items-center text-caribbean-green-800 dark:text-caribbean-green-500 hover:text-neutral-700 dark:hover:text-neutral-500 transition-colors duration-300"
			onclick="toSystemMode()" title="Switch to system default theme">
			<svg xmlns="http://www.w3.org/2000/svg" class="light-mode-icon h-8 w-8" fill="none" viewBox="0 0 24 24"
					 stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
							d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
			</svg>
		</button>
	</div>

</nav>
