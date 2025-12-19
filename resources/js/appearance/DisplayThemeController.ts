import {DisplayThemeResolver, ThemeIds} from './resolvers/DisplayThemeResolver'
import {DisplayModeResolver} from './resolvers/DisplayModeResolver'
import {DisplayModeUpdateRequested} from '../events/DisplayModeUpdateRequested'
import {DisplayThemeUpdateRequested} from '../events/DisplayThemeUpdateRequested'

export class DisplayThemeController {
	static init() {
		const controller = new DisplayThemeController()

		controller.init()
	}

	init() {
		document.addEventListener(
			DisplayThemeUpdateRequested.name,
			this.updateTheme.bind(this),
		)
	}

	updateTheme(event: DisplayThemeUpdateRequested) {
		const theme = event.theme

		if (!ThemeIds.includes(theme)) {
			console.warn(`Invalid theme: ${theme}`)
			return
		}

		const currentTheme = DisplayThemeResolver.resolve()
		const prefersDark = DisplayModeResolver.prefersDark()

		console.info(`current theme: ${currentTheme.id}`)

		if (theme === 'light') {
			document.dispatchEvent(
				new DisplayModeUpdateRequested(prefersDark ? 'light' : 'system'),
			)
		}

		if (theme === 'dark') currentTheme.toCyberneticTheme()

		if (theme === 'dark2') currentTheme.toIndustrialTheme()
	}
}
