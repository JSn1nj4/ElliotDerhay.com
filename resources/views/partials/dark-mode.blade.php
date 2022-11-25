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
