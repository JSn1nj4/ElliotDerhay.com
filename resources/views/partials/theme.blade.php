<!--
	Lazily copied from Laravel.com...
	- Mode functions: https://github.com/laravel/laravel.com-next/blob/a2a98ffe47761f15903f7a1e80e2bf948771ea03/resources/js/components/theme.js
	- Most of the inline script below: https://github.com/laravel/laravel.com-next/blob/a2a98ffe47761f15903f7a1e80e2bf948771ea03/resources/views/partials/layout.blade.php
	- Modified to add an extra dark theme
-->
<script>
	function inTheDark() {
		return document.documentElement.classList.contains('dark')
	}

	function funThemeEnabled() {
		return localStorage.getItem('funMode') === 'true'
			|| document.documentElement.classList.contains('fun')
	}

	function canEnableFunTheme() {
		return inTheDark()
	}

	function maybeEnableFunTheme() {
		if (!inTheDark()) return

		localStorage.setItem('funMode', 'true')
		document.documentElement.classList.add('fun')
	}

	function disableFunTheme() {
		if (!funThemeEnabled()) return

		localStorage.setItem('funMode', 'false')
		document.documentElement.classList.remove('fun')
	}

	function toggleFunTheme() {
		if (funThemeEnabled()) {
			disableFunTheme()
			return
		}

		maybeEnableFunTheme()
	}

	function toDarkMode() {
		localStorage.theme = 'dark'
		updateTheme()
	}

	function toLightMode() {
		localStorage.theme = 'light'
		updateTheme()
	}

	function toSystemMode() {
		localStorage.theme = 'system'
		updateTheme()
	}

	window
		.matchMedia('(prefers-color-scheme: dark)')
		.addEventListener('change', e => {
			if (localStorage.theme !== 'system') return

			if (e.matches) {
				document.documentElement.classList.add('dark')
				return
			}

			document.documentElement.classList.remove('dark')
		})

	function updateTheme() {
		if (!('theme' in localStorage)) {
			localStorage.theme = 'system'
		}

		switch (localStorage.theme) {
			case 'system':
				document.documentElement.setAttribute('color-theme', 'system')

				if (!window.matchMedia('(prefers-color-scheme: dark)').matches) {
					document.documentElement.classList.remove('dark')
					disableFunTheme()
					return
				}

				document.documentElement.classList.add('dark')

				// this seems redundant, but there are 2 pieces to the 'fun' theme and it's possible for 1 to be set without the other
				if (funThemeEnabled()) {
					maybeEnableFunTheme()
				}

				break

			case 'dark':
				document.documentElement.classList.add('dark')
				document.documentElement.setAttribute('color-theme', 'dark')

				// this seems redundant, but there are 2 pieces to the 'fun' theme and it's possible for 1 to be set without the other
				if (funThemeEnabled()) {
					maybeEnableFunTheme()
				}

				break

			case 'light':
				document.documentElement.classList.remove('dark')
				disableFunTheme()
				document.documentElement.setAttribute('color-theme', 'light')
				break
		}
	}

	updateTheme()
</script>
