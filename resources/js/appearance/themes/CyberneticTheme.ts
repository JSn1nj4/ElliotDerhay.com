import {DisplayTheme} from './DisplayTheme'

export class CyberneticTheme extends DisplayTheme {
	init(): void {
		this.updateStorage('dark').broadcast('dark')

		document.documentElement.classList.add('dark')
		document.documentElement.classList.remove('dark2')
	}

	isDark(): boolean {
		return true
	}

	resolve(): CyberneticTheme {
		return this
	}

	toCyberneticTheme(): CyberneticTheme {
		console.warn('Display theme is already cybernetic. Doing nothing.')
		return this
	}
}
