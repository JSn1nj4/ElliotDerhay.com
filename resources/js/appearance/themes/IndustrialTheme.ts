import {DisplayTheme} from './DisplayTheme'

export class IndustrialTheme extends DisplayTheme {
	init() {
		this.updateStorage('dark2').broadcast('dark2')

		document.documentElement.classList.add('dark')
		document.documentElement.classList.add('dark2')
	}

	isDark() {
		return true
	}

	resolve() {
		return this
	}

	toIndustrialTheme() {
		console.warn('Display theme is already industrial. Doing nothing.')
		return this
	}
}
