<header id="header" class="flex-initial border-b-4 border-solid border-sea-green-500">
	<div class="container-flexible-large m-auto">
		<nav class="flex items-center justify-between flex-wrap bg-gray-900 relative">

			<div class="flex items-center flex-grow lg:flex-shrink-0 text-white">
				<a href="/" class="text-white p-2">
					<img src="https://www.gravatar.com/avatar/8754c5b823c1f0b00e989447a0345a33" width="60" height="60" alt="ElliotDerhay.com logo" title="Elliot Derhay" class="inline border-solid border-2 border-white rounded-full align-middle">
					<span class="text-xl sm:text-3xl tracking-tighter py-px2 pl-2 align-middle">
						Elliot Derhay
					</span>
				</a>
			</div>

			<div class="block lg:hidden mr-4">
				<label for="menu-toggle" class="flex items-center text-sea-green-500 hover:text-white transition-colors duration-300">
					<svg class="fill-current h-8 w-8" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
				</label>
			</div>

			<input type="checkbox" id="dark-mode-toggle" name="dark-mode-toggle" class="hidden absolute top-0 left-0 -z-50">

			<div class="block lg:hidden mr-3 border-l-2 border-solid border-sea-green-800 pl-3" id="dark-mode-toggle-button">
				<label for="dark-mode-toggle" class="flex items-center text-sea-green-500 hover:text-gray-500 opacity-70 transition-colors duration-300">
					<svg id="light-mode" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
					</svg>
					<svg id="dark-mode" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
					</svg>
				</label>
			</div>

			<input type="checkbox" id="menu-toggle" name="menu-toggle" class="hidden absolute top-0 left-0 -z-50">

			<div class="w-full block absolute lg:relative flex-grow lg:flex lg:items-center lg:w-auto text-center lg:text-right text-xl mobile-menu">
				<div class="text-md lg:flex-grow">

					@foreach ($menuItems as $key => $item)
						<a href="{{ route($item->name, absolute: false) }}"
						class="block lg:inline-block px-4 py-6 uppercase{{ Route::currentRouteName() === $item->name ? ' active' : '' }}">
							@if(isset($item->icon))
								<i class="{{$item->icon}}"></i>
							@endif
							{{ $item->label }}
						</a>
					@endforeach

				</div>
			</div>

		</nav>
	</div>
</header>
