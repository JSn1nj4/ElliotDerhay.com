import {LightDisplayMode} from '../modes/LightDisplayMode'
import {DisplayThemeResolver} from '../resolvers/DisplayThemeResolver'
import {DisplayModeResolver} from '../resolvers/DisplayModeResolver'

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

	toLightMetallicTheme(): DisplayTheme {
		/** @todo clean up */
		console.info('Display theme updating to light: metallic.')

		const root = document.documentElement
		root.classList.remove('dark')
		root.classList.remove('dark2')

		return DisplayThemeResolver.light()
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

		return DisplayThemeResolver.dark()
			.updateDocAttribute('dark')
			.updateStorage('dark')
			.broadcast('dark')
	}

	toIndustrialTheme(): DisplayTheme {
		/** @todo clean up */
		console.info('Display theme updating to dark 2: industrial.')

		if (
			DisplayModeResolver.resolve() instanceof LightDisplayMode ||
			!DisplayModeResolver.prefersDark()
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

		return DisplayThemeResolver.dark2()
			.updateStorage('dark2')
			.broadcast('dark2')
	}

	toSystemAppropriate(): DisplayTheme {
		if (!DisplayModeResolver.prefersDark()) return this.toLightMetallicTheme()

		if (!this.isDark()) return this.toCyberneticTheme()
	}

	updateDocAttribute(value: string): DisplayTheme {
		document.documentElement.setAttribute('color-theme', value)

		return this
	}

	updateStorage(value: string): DisplayTheme {
		localStorage.setItem(DisplayThemeResolver.storageKey, value)

		return this
	}
}
