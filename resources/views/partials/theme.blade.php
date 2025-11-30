<!--
	Lazily copied from Laravel.com...
	- Mode functions: https://github.com/laravel/laravel.com-next/blob/a2a98ffe47761f15903f7a1e80e2bf948771ea03/resources/js/components/theme.js
	- Most of the inline script below: https://github.com/laravel/laravel.com-next/blob/a2a98ffe47761f15903f7a1e80e2bf948771ea03/resources/views/partials/layout.blade.php
	- Modified to add an extra dark theme
-->
<script>
	const storageKeyId = 'storageKey'

	class DisplayMode {
		static resolve() {
			const displayMode = localStorage.getItem(displayModes.storageKey)

			if (displayMode === null || displayMode === undefined) {
				return displayModes.system
			}

			if (!displayModes.hasOwnProperty(localStorage.getItem('displayMode'))) {
				return displayModes.system
			}

			if (displayMode === storageKeyId) {
				return displayModes.system
			}

			return displayModes[displayMode]
		}

		resolve() {
			return this.constructor.resolve()
		}

		toSystemDefault() {
			console.info('Display mode updated to system default.')
			return displayModes.system
		}

		toLightMode() {
			console.info('Display mode updated to light mode.')
			return displayModes.light
		}

		toDarkMode() {
			console.info('Display mode updated to dark mode.')
			return displayModes.dark
		}
	}

	class SystemDisplayMode extends DisplayMode {
		resolve() {
			return this
		}

		toSystemDefault() {
			console.warn('Display mode is already system default. Doing nothing.')
		}
	}

	class LightDisplayMode extends DisplayMode {
		resolve() {
			return this
		}

		toLightMode() {
			console.warn('Display mode is already light mode. Doing nothing.')
		}
	}

	class DarkDisplayMode extends DisplayMode {
		resolve() {
			return this
		}

		toDarkMode() {
			console.warn('Display mode is already dark mode. Doing nothing.')
		}
	}

	const displayModes = {
		[storageKeyId]: 'displayMode',
		'system': new SystemDisplayMode(),
		'light': new LightDisplayMode(),
		'dark': new DarkDisplayMode(),
	}

	class DisplayTheme {
		static resolve() {
			const displayTheme = localStorage.getItem(displayThemes.storageKey)

			if (displayTheme === null || displayTheme === undefined) {
				return displayThemes.light
			}

			if (!displayThemes.hasOwnProperty(displayTheme)) {
				return displayThemes.light
			}

			if (displayTheme === storageKeyId) {
				return displayThemes.light
			}

			return displayThemes[displayTheme]
		}

		resolve() {
			return this.constructor.resolve()
		}

		toLightMetallicTheme() {
			console.info('Display theme updated to default: light metallic.')
			return displayThemes.light
		}

		toCyberneticTheme() {
			console.info('Display theme updated to dark 1: cybernetic.')
			return displayThemes.dark
		}

		toIndustrialTheme() {
			console.info('Display theme updated to dark 2: industrial.')
			return displayThemes.dark2
		}
	}

	class LightMetallicTheme extends DisplayTheme {
		resolve() {
			return this
		}

		toLightMetallicTheme() {
			console.warn('Display theme is already light metallic. Doing nothing.')
		}
	}

	class CyberneticTheme extends DisplayTheme {
		resolve() {
			return this
		}

		toCyberneticTheme() {
			console.warn('Display theme is already cybernetic. Doing nothing.')
		}
	}

	class IndustrialTheme extends DisplayTheme {
		resolve() {
			return this
		}

		toIndustrialTheme() {
			console.warn('Display theme is already industrial. Doing nothing.')
		}
	}

	const displayThemes = {
		[storageKeyId]: 'displayTheme',
		'light': new LightMetallicTheme(),
		'dark': new CyberneticTheme(),
		'dark2': new IndustrialTheme(),
	}

	function initDisplayConfig() {
		const displayMode = DisplayMode.resolve()
	}

	// ^^ new stuff ^^

	// vv old stuff vv

	function inTheDark() {
		return document.documentElement.classList.contains('dark')
	}

	function funThemeEnabled() {
		return localStorage.getItem('funMode') === 'true'
			|| document.documentElement.classList.contains('dark2')
	}

	function canEnableFunTheme() {
		return inTheDark()
	}

	function maybeEnableFunTheme() {
		if (!inTheDark()) return

		localStorage.setItem('funMode', 'true')
		document.documentElement.classList.add('dark2')
	}

	function disableFunTheme() {
		if (!funThemeEnabled()) return

		localStorage.setItem('funMode', 'false')
		document.documentElement.classList.remove('dark2')
	}

	function toggleFunTheme() {
		if (funThemeEnabled()) {
			disableFunTheme()
			return
		}

		maybeEnableFunTheme()
	}

	function toDarkMode() {
		localStorage.setItem('theme', 'dark')
		updateTheme()
	}

	function toLightMode() {
		localStorage.setItem('theme', 'light')
		updateTheme()
	}

	function toSystemMode() {
		localStorage.setItem('theme', 'system')
		updateTheme()
	}

	window
		.matchMedia('(prefers-color-scheme: dark)')
		.addEventListener('change', e => {
			if (localStorage.getItem('theme') !== 'system') return

			if (e.matches) {
				document.documentElement.classList.add('dark')
				return
			}

			document.documentElement.classList.remove('dark')
		})

	function updateTheme() {
		if (!('theme' in localStorage)) {
			localStorage.setItem('theme', 'system')
		}

		switch (localStorage.getItem('theme')) {
			case 'system':
				document.documentElement.setAttribute('color-theme', 'system')

				if (!window.matchMedia('(prefers-color-scheme: dark)').matches) {
					document.documentElement.classList.remove('dark')
					disableFunTheme()
					return
				}

				document.documentElement.classList.add('dark')

				// this seems redundant, but there are 2 pieces to the 'dark2' theme and it's possible for 1 to be set without the other
				if (funThemeEnabled()) {
					maybeEnableFunTheme()
				}

				break

			case 'dark':
				document.documentElement.classList.add('dark')
				document.documentElement.setAttribute('color-theme', 'dark')

				// this seems redundant, but there are 2 pieces to the 'dark2' theme and it's possible for 1 to be set without the other
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
