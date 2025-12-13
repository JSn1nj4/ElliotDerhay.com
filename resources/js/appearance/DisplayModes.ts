import {DisplayTheme, LightGreyTheme} from './DisplayThemes'
import {DisplayThemeResolver} from './resolvers/DisplayThemeResolver'
import {
	DisplayModeResolver,
	modeStorageKey,
} from './resolvers/DisplayModeResolver'

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

	toSystemDefault(): SystemDisplayMode {
		const displayTheme = DisplayThemeResolver.resolve()

		let step = () => displayTheme

		if (!DisplayModeResolver.prefersDark()) {
			// this just pushes it to light grey theme if darkness is not preferred and in case it currently is 'dark'
			step = () => displayTheme.toLightGreyTheme()
		} else if (!displayTheme.isDark()) {
			// this just pushes it to the Cybernetic theme if darkness is preferred and it's currently light
			step = () => displayTheme.toCyberneticTheme()
		}

		step()

		return DisplayModeResolver.system()
			.updateStorage('system')
			.broadcast('system')
	}

	toLightMode(): LightDisplayMode {
		DisplayThemeResolver.resolve().toLightGreyTheme()

		return DisplayModeResolver.light().updateStorage('light').broadcast('light')
	}

	toDarkMode(): DarkDisplayMode {
		const displayTheme = DisplayThemeResolver.resolve()

		if (displayTheme instanceof LightGreyTheme) {
			displayTheme.toCyberneticTheme()
		}

		return DisplayModeResolver.dark().updateStorage('dark').broadcast('dark')
	}

	updateStorage(value: string): this {
		localStorage.setItem(modeStorageKey, value)

		return this
	}
}

export class SystemDisplayMode extends DisplayMode {
	syncTheme(currentTheme: DisplayTheme): void {
		currentTheme.toSystemAppropriate()
	}

	toSystemDefault(): this {
		return this
	}
}

export class LightDisplayMode extends DisplayMode {
	get id() {
		return 'light'
	}

	syncTheme(currentTheme: DisplayTheme): void {
		currentTheme.toLightGreyTheme()
	}

	toLightMode(): this {
		return this
	}
}

export class DarkDisplayMode extends DisplayMode {
	get id() {
		return 'dark'
	}

	syncTheme(currentTheme: DisplayTheme): void {
		if (currentTheme.isDark()) return

		currentTheme.toCyberneticTheme()
	}

	toDarkMode(): this {
		return this
	}
}
