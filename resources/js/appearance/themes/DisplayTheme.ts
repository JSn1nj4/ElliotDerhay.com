import {displayThemes, storageKeyId} from '../registry'
import {DisplayMode} from '../modes/DisplayMode'
import {LightDisplayMode} from '../modes/LightDisplayMode'

export class DisplayTheme {
	broadcast(value: string): DisplayTheme {
		document.dispatchEvent(
			new CustomEvent('display_theme.updated', {
				detail: {theme: value},
			}),
		)

		return this
	}

	init(): void {}

	isDark(): boolean {
		return false
	}

	static resolve(): DisplayTheme {
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

	resolve(): DisplayTheme {
		return DisplayTheme.resolve()
	}

	toLightMetallicTheme(): DisplayTheme {
		/** @todo clean up */
		console.info('Display theme updating to light: metallic.')

		const root = document.documentElement
		root.classList.remove('dark')
		root.classList.remove('dark2')

		return displayThemes.light
			.updateDocAttribute('light')
			.updateStorage('light')
			.broadcast('light')
	}

	toCyberneticTheme(): DisplayTheme {
		/** @todo clean up */
		console.info('Display theme updating to dark 1: cybernetic.')

		const root = document.documentElement
		if (root.classList.contains('dark2')) root.classList.remove('dark2')
		if (!root.classList.contains('dark')) root.classList.add('dark')

		return displayThemes.dark
			.updateDocAttribute('dark')
			.updateStorage('dark')
			.broadcast('dark')
	}

	toIndustrialTheme(): DisplayTheme {
		/** @todo clean up */
		console.info('Display theme updating to dark 2: industrial.')

		if (
			DisplayMode.resolve() instanceof LightDisplayMode ||
			!DisplayMode.prefersDark()
		) {
			console.warn('Industrial theme is not supported in light mode.')
			return this
		}

		if (!document.documentElement.classList.contains('dark')) {
			document.documentElement.classList.add('dark')
		}
		if (!document.documentElement.classList.contains('dark2')) {
			document.documentElement.classList.add('dark2')
		}

		return displayThemes.dark2.updateStorage('dark2').broadcast('dark2')
	}

	toSystemAppropriate(): DisplayTheme {
		if (!DisplayMode.prefersDark()) return this.toLightMetallicTheme()

		if (!this.isDark()) return this.toCyberneticTheme()
	}

	updateDocAttribute(value: string): DisplayTheme {
		document.documentElement.setAttribute('color-theme', value)

		return this
	}

	updateStorage(value: string): DisplayTheme {
		localStorage.setItem(displayThemes.storageKey, value)

		return this
	}
}
