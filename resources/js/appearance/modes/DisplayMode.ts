import {DisplayTheme} from '../themes/DisplayTheme'
import {LightMetallicTheme} from '../themes/LightMetallicTheme'
import {DisplayThemeResolver} from '../resolvers/DisplayThemeResolver'
import {DisplayModeResolver} from '../resolvers/DisplayModeResolver'

export class DisplayMode {
	get id() {
		return 'system'
	}

	broadcast(value: string): DisplayMode {
		document.dispatchEvent(
			new CustomEvent('display_mode.updated', {
				detail: {mode: value},
			}),
		)

		return this
	}

	syncTheme(currentTheme: DisplayTheme): void {}

	toSystemDefault(): DisplayMode {
		/** @todo clean up */
		console.info('Display mode updating to system default.')

		const displayTheme = DisplayThemeResolver.resolve()

		let step = () => displayTheme

		if (!DisplayModeResolver.prefersDark()) {
			// this just pushes it to light metallic theme if darkness is not preferred and in case it currently is 'dark'
			step = () => displayTheme.toLightMetallicTheme()
		} else if (!displayTheme.isDark()) {
			// this just pushes it to the Cybernetic theme if darkness is preferred and it's currently light
			step = () => displayTheme.toCyberneticTheme()
		}

		step()

		return DisplayModeResolver.system()
			.updateStorage('system')
			.broadcast('system')
	}

	toLightMode(): DisplayMode {
		/** @todo clean up */
		console.info('Display mode updating to light mode.')

		DisplayThemeResolver.resolve().toLightMetallicTheme()
		return DisplayModeResolver.light().updateStorage('light').broadcast('light')
	}

	toDarkMode(): DisplayMode {
		/** @todo clean up */
		console.info('Display mode updating to dark mode.')

		const displayTheme = DisplayThemeResolver.resolve()

		if (displayTheme instanceof LightMetallicTheme) {
			displayTheme.toCyberneticTheme()
		}

		return DisplayModeResolver.dark().updateStorage('dark').broadcast('dark')
	}

	updateStorage(value: string): DisplayMode {
		localStorage.setItem(DisplayModeResolver.storageKey, value)

		return this
	}
}
