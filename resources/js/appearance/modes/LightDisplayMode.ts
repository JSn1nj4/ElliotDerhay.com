import {DisplayMode} from './DisplayMode'
import type {DisplayTheme} from '../themes/DisplayTheme'

export class LightDisplayMode extends DisplayMode {
	get id() {
		return 'light'
	}

	syncTheme(currentTheme: DisplayTheme): void {
		currentTheme.toLightMetallicTheme()
	}

	toLightMode(): LightDisplayMode {
		console.warn('Display mode is already light mode. Doing nothing.')
		return this
	}
}
