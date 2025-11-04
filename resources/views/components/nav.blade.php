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

	<div class="block lg:hidden mr-4">
		<label for="menu-toggle"
					 class="flex items-center text-bright-turquoise-900 dark:text-bright-turquoise-500 hover:text-bright-turquoise-600 dark:hover:text-white transition-colors duration-300">
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

	<x-nav.options />

</nav>
