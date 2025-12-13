import {DisplayThemeResolver, ThemeIds} from './resolvers/DisplayThemeResolver'
import {DisplayModeResolver} from './resolvers/DisplayModeResolver'

export class DisplayThemeController {
	static init() {
		const controller = new DisplayThemeController()

		controller.init()
	}

	init() {
		document.addEventListener(
			'display_theme.update',
			this.updateTheme.bind(this),
		)
	}

	updateTheme(event: CustomEvent) {
		const theme = event?.detail?.theme

		if (!ThemeIds.includes(theme)) {
			console.warn(`Invalid theme: ${theme}`)
			return
		}

		const currentTheme = DisplayThemeResolver.resolve()
		const prefersDark = DisplayModeResolver.prefersDark()

		console.info(`current theme: ${currentTheme.id}`)

		if (theme === 'light') {
			document.dispatchEvent(
				new CustomEvent('display_mode.update', {
					detail: {mode: prefersDark ? 'light' : 'system'},
				}),
			)
		}

		if (theme === 'dark') currentTheme.toCyberneticTheme()

		if (theme === 'dark2') currentTheme.toIndustrialTheme()
	}
}
