import {DisplayMode} from './DisplayMode'
import {DisplayTheme} from '../themes/DisplayTheme'

export class SystemDisplayMode extends DisplayMode {
	init(): void {
		this.updateStorage('system').broadcast('system')

		super.init()
	}

	resolve(): SystemDisplayMode {
		return this
	}

	syncTheme(currentTheme: DisplayTheme): void {
		currentTheme.toSystemAppropriate()
	}

	toSystemDefault(): SystemDisplayMode {
		console.warn('Display mode is already system default. Doing nothing.')
		return this
	}
}
