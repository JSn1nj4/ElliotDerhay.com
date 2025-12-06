<script>
	const storageKeyId = 'storageKey'

	class DisplayMode {
		broadcast(value) {
			document.dispatchEvent(new CustomEvent('display_mode.updated', {
				detail: {mode: value},
			}))
		}

		init() {
			DisplayTheme.resolve().init()
		}

		static prefersDark() {
			return window.matchMedia('(prefers-color-scheme: dark)').matches
		}

		static resolve() {
			const displayMode = localStorage.getItem(displayModes.storageKey)

			if (displayMode === null || displayMode === undefined) {
				return displayModes.system
			}

			if (displayMode === storageKeyId) {
				return displayModes.system
			}

			if (!displayModes.hasOwnProperty(localStorage.getItem(displayModes.storageKey))) {
				return displayModes.system
			}

			return displayModes[displayMode]
		}

		resolve() {
			return this.constructor.resolve()
		}

		toSystemDefault() {
			console.info('Display mode updating to system default.')

			const displayTheme = DisplayTheme.resolve()

			if (!this.constructor.prefersDark()) {
				// this just pushes it to light metallic theme if darkness is not preferred and in case it currently is 'dark'
				displayTheme.toLightMetallicTheme()
				return this
			}

			if (displayTheme instanceof LightMetallicTheme) {
				// this just pushes it to the Cybernetic theme if darkness is preferred and it's currently light
				displayTheme.toCyberneticTheme()
				return this
			}

			return displayModes.system
				.updateStorage('system')
				.broadcast('system')
		}

		toLightMode() {
			console.info('Display mode updating to light mode.')

			DisplayTheme.resolve().toLightMetallicTheme()
			return displayModes.light
				.updateStorage('light')
				.broadcast('light')
		}

		toDarkMode() {
			console.info('Display mode updating to dark mode.')

			const displayTheme = DisplayTheme.resolve()

			if (displayTheme instanceof LightMetallicTheme) {
				displayTheme.toCyberneticTheme()
			}

			return displayModes.dark
				.updateStorage('dark')
				.broadcast('dark')
		}

		updateStorage(value) {
			localStorage.setItem(displayModes.storageKey, value)

			return this
		}
	}

	class SystemDisplayMode extends DisplayMode {
		init() {
			this.updateStorage('system')
				.broadcast('system')

			super.init()
		}

		resolve() {
			return this
		}

		toSystemDefault() {
			console.warn('Display mode is already system default. Doing nothing.')
			return this
		}
	}

	class LightDisplayMode extends DisplayMode {
		init() {
			this.updateStorage('light')
				.broadcast('light')

			super.init()
		}

		resolve() {
			return this
		}

		toLightMode() {
			console.warn('Display mode is already light mode. Doing nothing.')
			return this
		}
	}

	class DarkDisplayMode extends DisplayMode {
		init() {
			this.updateStorage('dark')
				.broadcast('dark')

			super.init()
		}

		resolve() {
			return this
		}

		toDarkMode() {
			console.warn('Display mode is already dark mode. Doing nothing.')
			return this
		}
	}

	const displayModes = {
		[storageKeyId]: 'displayMode',
		'system': new SystemDisplayMode(),
		'light': new LightDisplayMode(),
		'dark': new DarkDisplayMode(),
	}

	class DisplayTheme {
		broadcast(value) {
			document.dispatchEvent(new CustomEvent('display_theme.updated', {
				detail: {theme: value},
			}))
		}

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
			console.info('Display theme updating to light: metallic.')

			const root = document.documentElement
			root.classList.remove('dark')
			root.classList.remove('dark2')

			return displayThemes.light
				.updateDocAttribute('light')
				.updateStorage('light')
				.broadcast('light')
		}

		toCyberneticTheme() {
			console.info('Display theme updating to dark 1: cybernetic.')

			const root = document.documentElement
			if (root.classList.contains('dark2')) root.classList.remove('dark2')
			if (!root.classList.contains('dark')) root.classList.add('dark')

			return displayThemes.dark
				.updateDocAttribute('dark')
				.updateStorage('dark')
				.broadcast('dark')
		}

		toIndustrialTheme() {
			console.info('Display theme updating to dark 2: industrial.')

			if (DisplayMode.resolve() instanceof LightDisplayMode || !DisplayMode.prefersDark()) {
				console.warn('Industrial theme is not supported in light mode.')
				return this
			}

			const root = document.documentElement
			if (!root.classList.contains('dark')) root.classList.add('dark')
			if (!root.classList.contains('dark2')) root.classList.add('dark2')

			return displayThemes.dark2
				.updateStorage('dark2')
				.broadcast('dark2')
		}

		updateDocAttribute(value) {
			document.documentElement.setAttribute('color-theme', value)

			return this
		}

		updateStorage(value) {
			localStorage.setItem(displayThemes.storageKey, value)

			return this
		}
	}

	class LightMetallicTheme extends DisplayTheme {
		init() {
			this.updateStorage('light')
				.broadcast('light')

			document.documentElement.classList.remove('dark')
			document.documentElement.classList.remove('dark2')
		}

		resolve() {
			return this
		}

		toLightMetallicTheme() {
			console.warn('Display theme is already light metallic. Doing nothing.')
			return this
		}
	}

	class CyberneticTheme extends DisplayTheme {
		init() {
			this.updateStorage('dark')
				.broadcast('dark')

			document.documentElement.classList.add('dark')
			document.documentElement.classList.remove('dark2')
		}

		resolve() {
			return this
		}

		toCyberneticTheme() {
			console.warn('Display theme is already cybernetic. Doing nothing.')
			return this
		}
	}

	class IndustrialTheme extends DisplayTheme {
		init() {
			this.updateStorage('dark2')
				.broadcast('dark2')

			document.documentElement.classList.add('dark')
			document.documentElement.classList.add('dark2')
		}

		resolve() {
			return this
		}

		toIndustrialTheme() {
			console.warn('Display theme is already industrial. Doing nothing.')
			return this
		}
	}

	const displayThemes = {
		[storageKeyId]: 'displayTheme',
		'light': new LightMetallicTheme(),
		'dark': new CyberneticTheme(),
		'dark2': new IndustrialTheme(),
	}

	class DisplayController {
		init() {
			// this only responds to a system preference change
			window.matchMedia('(prefers-color-scheme: dark)')
				.addEventListener('change', e => {
					if (localStorage.getItem(displayModes.storageKey) !== 'system') return

					if (e.matches) {
						DisplayMode.resolve().toDarkMode()
						return
					}

					DisplayMode.resolve().toLightMode()
				})

			document.addEventListener('display_mode.update', this.updateMode.bind(this))
			document.addEventListener('display_theme.update', this.updateTheme.bind(this))

			DisplayMode.resolve().init()
		}

		updateMode(event) {
			const mode = event?.detail?.mode

			if (
				typeof mode !== 'string'
				|| mode === storageKeyId
				|| !(mode in displayModes)
			) {
				console.warn(`Invalid mode: ${mode}`)
				return
			}

			const current = DisplayMode.resolve()

			if (mode === 'system') current.toSystemDefault()

			if (mode === 'light') current.toLightMode()

			if (mode === 'dark') current.toDarkMode()
		}

		updateTheme(event) {
			const theme = event?.detail?.theme

			if (
				typeof theme !== 'string'
				|| theme === storageKeyId
				|| !(theme in displayThemes)
			) {
				console.warn(`Invalid theme: ${theme}`)
				return
			}

			const current = DisplayTheme.resolve()

			if (theme === 'light') current.toLightMetallicTheme()

			if (theme === 'dark') current.toCyberneticTheme()

			if (theme === 'dark2') current.toIndustrialTheme()
		}
	}

	window.addEventListener('load', function() {
		const controller = new DisplayController()
		controller.init()
	})
</script>
