import {ThemeId} from '../appearance/resolvers/DisplayThemeResolver'

export class DisplayThemeUpdated extends Event {
	static readonly name = 'display_theme.updated'

	theme: ThemeId

	constructor(theme: ThemeId) {
		super(DisplayThemeUpdated.name, {bubbles: true, cancelable: true})

		this.theme = theme
	}
}
