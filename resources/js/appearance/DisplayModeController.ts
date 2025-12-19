import {
	DisplayModeResolver,
	ModeIds,
	modeStorageKey,
} from './resolvers/DisplayModeResolver'
import {DisplayThemeResolver} from './resolvers/DisplayThemeResolver'
import {DisplayThemeController} from './DisplayThemeController'

export class DisplayModeController {
	init() {
		DisplayThemeController.init()

		// this only responds to a system preference change
		window
			.matchMedia('(prefers-color-scheme: dark)')
			.addEventListener('change', e => {
				if (localStorage.getItem(modeStorageKey) !== 'system') return

				if (e.matches) {
					DisplayModeResolver.resolve().toDarkMode()
					return
				}

				DisplayModeResolver.resolve().toLightMode()
			})

		document.addEventListener('display_mode.update', this.updateMode.bind(this))
		document.addEventListener('livewire:navigated', this.initDisplay.bind(this))

		this.initDisplay()
	}

	initDisplay() {
		const currentMode = DisplayModeResolver.resolve()
		const currentTheme = DisplayThemeResolver.resolve()

		currentTheme.init()

		currentMode
			.updateStorage(currentMode.id)
			.broadcast(currentMode.id)
			.syncTheme(currentTheme)
	}

	updateMode(event: CustomEvent): void {
		const mode = event?.detail?.mode

		if (!ModeIds.includes(mode)) {
			console.warn(`Invalid mode: ${mode}`)
			return
		}

		const current = DisplayModeResolver.resolve()

		if (mode === 'system') current.toSystemDefault()

		if (mode === 'light') current.toLightMode()

		if (mode === 'dark') current.toDarkMode()
	}
}
