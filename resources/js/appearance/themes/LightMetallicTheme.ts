import {DisplayTheme} from './DisplayTheme'

export class LightMetallicTheme extends DisplayTheme {
	init(): void {
		this.updateStorage('light').broadcast('light')

		document.documentElement.classList.remove('dark')
		document.documentElement.classList.remove('dark2')
	}

	resolve(): LightMetallicTheme {
		return this
	}

	toLightMetallicTheme(): LightMetallicTheme {
		console.warn('Display theme is already light metallic. Doing nothing.')
		return this
	}
}
