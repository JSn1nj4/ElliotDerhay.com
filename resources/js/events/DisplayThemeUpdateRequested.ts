import {ThemeId} from '../appearance/resolvers/DisplayThemeResolver'

export class DisplayThemeUpdateRequested extends Event {
	static readonly name = 'display_theme.update_requested'

	theme: ThemeId

	constructor(theme: ThemeId) {
		super(DisplayThemeUpdateRequested.name, {bubbles: true, cancelable: true})

		this.theme = theme
	}
}
