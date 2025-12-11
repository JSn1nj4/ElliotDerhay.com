import {LightMetallicTheme} from '../themes/LightMetallicTheme'
import {CyberneticTheme} from '../themes/CyberneticTheme'
import {IndustrialTheme} from '../themes/IndustrialTheme'
import type {DisplayTheme} from '../themes/DisplayTheme'

export const ThemeIds = ['light', 'dark', 'dark2']

type ThemeId = typeof ThemeIds[number]

export class DisplayThemeResolver {
	static storageKey: 'displayTheme'

	static currentId(): ThemeId {
		const displayTheme = localStorage.getItem(DisplayThemeResolver.storageKey)

		if (!ThemeIds.includes(displayTheme)) return 'light'

		return displayTheme
	}

	static resolve(): DisplayTheme {
		return DisplayThemeResolver[DisplayThemeResolver.currentId()]()
	}

	static light() {
		return new LightMetallicTheme()
	}

	static dark() {
		return new CyberneticTheme()
	}

	static dark2() {
		return new IndustrialTheme()
	}
}
