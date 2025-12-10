import {DisplayTheme} from './DisplayTheme'

export class LightMetallicTheme extends DisplayTheme {
	init() {
		this.updateStorage('light').broadcast('light')

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
