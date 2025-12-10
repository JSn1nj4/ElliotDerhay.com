import {displayModes, displayThemes, storageKeyId} from './registry'
import {DisplayMode} from './modes/DisplayMode'
import {DisplayTheme} from './themes/DisplayTheme'

export class DisplayController {
	init() {
		// this only responds to a system preference change
		window
			.matchMedia('(prefers-color-scheme: dark)')
			.addEventListener('change', e => {
				if (localStorage.getItem(displayModes.storageKey) !== 'system') return

				if (e.matches) {
					DisplayMode.resolve().toDarkMode()
					return
				}

				DisplayMode.resolve().toLightMode()
			})

		document.addEventListener('display_mode.update', this.updateMode.bind(this))
		document.addEventListener(
			'display_theme.update',
			this.updateTheme.bind(this),
		)
		document.addEventListener('livewire:navigated', this.initDisplay.bind(this))

		this.initDisplay()
	}

	initDisplay() {
		DisplayMode.resolve().init()
	}

	updateMode(event: CustomEvent): void {
		const mode = event?.detail?.mode

		if (
			typeof mode !== 'string' ||
			mode === storageKeyId ||
			!(mode in displayModes)
		) {
			console.warn(`Invalid mode: ${mode}`)
			return
		}

		const current = DisplayMode.resolve()

		if (mode === 'system') current.toSystemDefault()

		if (mode === 'light') current.toLightMode()

		if (mode === 'dark') current.toDarkMode()
	}

	updateTheme(event: CustomEvent) {
		const theme = event?.detail?.theme

		if (
			typeof theme !== 'string' ||
			theme === storageKeyId ||
			!(theme in displayThemes)
		) {
			console.warn(`Invalid theme: ${theme}`)
			return
		}

		const currentTheme = DisplayTheme.resolve()
		const currentMode = DisplayMode.resolve()
		const prefersDark = DisplayMode.prefersDark()

		if (theme === 'light')
			prefersDark ? currentMode.toLightMode() : currentMode.toSystemDefault()

		if (theme === 'dark') currentTheme.toCyberneticTheme()

		if (theme === 'dark2') currentTheme.toIndustrialTheme()
	}
}
