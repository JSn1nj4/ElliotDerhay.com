import {DisplayMode} from './DisplayMode'
import {DisplayTheme} from '../themes/DisplayTheme'

export class DarkDisplayMode extends DisplayMode {
	init() {
		this.updateStorage('dark').broadcast('dark')

		super.init()
	}

	resolve() {
		return this
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
