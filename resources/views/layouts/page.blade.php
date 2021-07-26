@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@section('body')

	@php
		$menuItems = [
			(object) [
				'name' => 'home',
				'label' => 'Home',
				'icon' => 'fas fa-home',
			],
		];

		$optionalMenuItems = [
			(object) [
				'name' => 'projects',
				'label' => 'Projects',
			],
			(object) [
				'name' => 'updates',
				'label' => 'Updates',
			],
		];

		foreach($optionalMenuItems as $item) {
			if(config("app.enable-" . $item->name)) $menuItems[] = $item;
		}
	@endphp

	@include('layouts.header')

	<main class="bg-white dark:bg-black layer-shadow flex-grow">
		@yield('content')
	</main>

	@include('layouts.footer')

@endsection

@push('footer-extras')
	<div id="ga-request-popup" style="display: none;"></div>

	<script src="{{ mix('/js/manifest.js') }}"></script>
	<script src="{{ mix('/js/vendor.js') }}"></script>
	<script src="{{ mix('/js/app.js') }}"></script>

	<script src="{{ mix('/js/GAPopup.js') }}" charset="utf-8"></script>

	<script type="application/javascript">
		EventBus.$on('allow_tracking', ga_track);
	</script>

	<!--
		Lazily copied from Laravel.com...

		- Mode functions: https://github.com/laravel/laravel.com-next/blob/a2a98ffe47761f15903f7a1e80e2bf948771ea03/resources/js/components/theme.js

		- Most of the inline script below: https://github.com/laravel/laravel.com-next/blob/a2a98ffe47761f15903f7a1e80e2bf948771ea03/resources/views/partials/layout.blade.php
	-->
	<script>
		function toDarkMode() {
			localStorage.theme = 'dark';
			window.updateTheme();
		}

		function toLightMode() {
			localStorage.theme = 'light';
			window.updateTheme();
		}

		function toSystemMode() {
			localStorage.theme = 'system';
			window.updateTheme();
		}

		window
			.matchMedia('(prefers-color-scheme: dark)')
			.addEventListener('change', e => {
				if (localStorage.theme === 'system') {
					if (e.matches) {
						document.documentElement.classList.add('dark');
					} else {
						document.documentElement.classList.remove('dark');
					}
				}
			});

		function updateTheme() {
			if (!('theme' in localStorage)) {
				localStorage.theme = 'system';
			}

			switch (localStorage.theme) {
				case 'system':
					if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
						document.documentElement.classList.add('dark');
					} else {
						document.documentElement.classList.remove('dark');
					}
					document.documentElement.setAttribute('color-theme', 'system');
					break;
				case 'dark':
					document.documentElement.classList.add('dark');
					document.documentElement.setAttribute('color-theme', 'dark');
					break;
				case 'light':
					document.documentElement.classList.remove('dark');
					document.documentElement.setAttribute('color-theme', 'light');
					break;
			}
		}

		updateTheme();
	</script>
@endpush
