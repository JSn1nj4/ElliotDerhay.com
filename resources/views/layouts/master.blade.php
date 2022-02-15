<!doctype html>
<html lang="{{ app()->getLocale() }}" color-theme="system">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#002e24">

		<title>ElliotDerhay.com</title>

		<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
		<script src="https://kit.fontawesome.com/a9f488e9e4.js" crossorigin="anonymous"></script>

		<link rel="shortcut icon" href="https://s3.amazonaws.com/elliotderhay-com/favicon.png">

		@stack('head-extras')

		<script type="application/javascript">
			// Enable or disable GA tracking
			function ga_track(track) {
				document.cookie = !track ? 'DNT=1' : 'DNT=0';
				window['ga-disable-UA-165049241-1'] = !track;
			}

			// Initial DNT setup
			ga_track(document.cookie.indexOf('DNT=0') !== -1 && navigator.doNotTrack !== '1');

			// tracking configuration
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-165049241-1');
		</script>
	</head>
	<body class="bg-white dark:bg-black text-black dark:text-white font-sans flex flex-col {{ $bodyClasses }}">
		@yield('body')

		@stack('footer-extras')

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
	</body>
</html>
