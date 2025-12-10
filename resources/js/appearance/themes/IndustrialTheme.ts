import {DisplayTheme} from './DisplayTheme'

export class IndustrialTheme extends DisplayTheme {
	init(): void {
		this.updateStorage('dark2').broadcast('dark2')

		document.documentElement.classList.add('dark')
		document.documentElement.classList.add('dark2')
	}

	isDark(): boolean {
		return true
	}

	resolve(): IndustrialTheme {
		return this
	}

	toIndustrialTheme(): IndustrialTheme {
		console.warn('Display theme is already industrial. Doing nothing.')
		return this
	}
}
