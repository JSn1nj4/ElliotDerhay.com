import {DisplayMode} from './DisplayMode'
import type {DisplayTheme} from '../themes/DisplayTheme'

export class DarkDisplayMode extends DisplayMode {
	get id() {
		return 'dark'
	}

	syncTheme(currentTheme: DisplayTheme): void {
		if (currentTheme.isDark()) return

		currentTheme.toCyberneticTheme()
	}

	toDarkMode() {
		console.warn('Display mode is already dark mode. Doing nothing.')
		return this
	}
}
