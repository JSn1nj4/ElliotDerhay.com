import {DisplayMode} from './DisplayMode'
import type {DisplayTheme} from '../themes/DisplayTheme'

export class SystemDisplayMode extends DisplayMode {
	syncTheme(currentTheme: DisplayTheme): void {
		currentTheme.toSystemAppropriate()
	}

	toSystemDefault(): SystemDisplayMode {
		console.warn('Display mode is already system default. Doing nothing.')
		return this
	}
}
