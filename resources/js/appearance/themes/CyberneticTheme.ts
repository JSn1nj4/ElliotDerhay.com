import {DisplayTheme} from './DisplayTheme'

export class CyberneticTheme extends DisplayTheme {
	init() {
		this.updateStorage('dark').broadcast('dark')

		document.documentElement.classList.add('dark')
		document.documentElement.classList.remove('dark2')
	}

	isDark() {
		return true
	}

	resolve() {
		return this
	}

	toCyberneticTheme() {
		console.warn('Display theme is already cybernetic. Doing nothing.')
		return this
	}
}
