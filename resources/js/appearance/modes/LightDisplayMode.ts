import {DisplayMode} from './DisplayMode'
import {DisplayTheme} from '../themes/DisplayTheme'

export class LightDisplayMode extends DisplayMode {
	init(): void {
		this.updateStorage('light').broadcast('light')

		super.init()
	}

	resolve(): LightDisplayMode {
		return this
	}

	syncTheme(currentTheme: DisplayTheme): void {
		currentTheme.toLightMetallicTheme()
	}

	toLightMode(): LightDisplayMode {
		console.warn('Display mode is already light mode. Doing nothing.')
		return this
	}
}
