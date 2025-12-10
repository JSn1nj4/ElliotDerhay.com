import {DisplayTheme} from '../themes/DisplayTheme'
import {SystemDisplayMode} from './SystemDisplayMode'
import {displayModes, storageKeyId} from '../registry'
import {LightMetallicTheme} from '../themes/LightMetallicTheme'
import {LightDisplayMode} from './LightDisplayMode'
import {DarkDisplayMode} from './DarkDisplayMode'

export class DisplayMode {
	broadcast(value: string): DisplayMode {
		document.dispatchEvent(
			new CustomEvent('display_mode.updated', {
				detail: {mode: value},
			}),
		)

		return this
	}

	init(): void {
		const currentTheme = DisplayTheme.resolve()

		currentTheme.init()

		this.syncTheme(currentTheme)
	}

	static prefersDark(): boolean {
		return window.matchMedia('(prefers-color-scheme: dark)').matches
	}

	static resolve(): DisplayMode {
		const displayMode = localStorage.getItem(displayModes.storageKey)

		if (displayMode === null || displayMode === undefined) {
			return displayModes.system
		}

		if (displayMode === storageKeyId) {
			return displayModes.system
		}

		if (
			!displayModes.hasOwnProperty(
				localStorage.getItem(displayModes.storageKey),
			)
		) {
			return displayModes.system
		}

		return displayModes[displayMode]
	}

	resolve(): DisplayMode {
		return DisplayMode.resolve()
	}

	syncTheme(currentTheme: DisplayTheme): void {}

	toSystemDefault(): SystemDisplayMode {
		/** @todo clean up */
		console.info('Display mode updating to system default.')

		const displayTheme = DisplayTheme.resolve()

		let step = () => {}

		if (!DisplayMode.prefersDark()) {
			// this just pushes it to light metallic theme if darkness is not preferred and in case it currently is 'dark'
			step = () => displayTheme.toLightMetallicTheme()
		} else if (displayTheme instanceof LightMetallicTheme) {
			// this just pushes it to the Cybernetic theme if darkness is preferred and it's currently light
			step = () => displayTheme.toCyberneticTheme()
		}

		step()

		return displayModes.system.updateStorage('system').broadcast('system')
	}

	toLightMode(): LightDisplayMode {
		/** @todo clean up */
		console.info('Display mode updating to light mode.')

		DisplayTheme.resolve().toLightMetallicTheme()
		return displayModes.light.updateStorage('light').broadcast('light')
	}

	toDarkMode(): DarkDisplayMode {
		/** @todo clean up */
		console.info('Display mode updating to dark mode.')

		const displayTheme = DisplayTheme.resolve()

		if (displayTheme instanceof LightMetallicTheme) {
			displayTheme.toCyberneticTheme()
		}

		return displayModes.dark.updateStorage('dark').broadcast('dark')
	}

	updateStorage(value: string): DisplayMode {
		localStorage.setItem(displayModes.storageKey, value)

		return this
	}
}
