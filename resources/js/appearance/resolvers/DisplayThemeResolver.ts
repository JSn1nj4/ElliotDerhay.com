import {
	CyberneticTheme,
	DisplayTheme,
	IndustrialTheme,
	LightGreyTheme,
} from '../DisplayThemes'

export const ThemeIds = ['light', 'dark', 'dark2']

type ThemeId = typeof ThemeIds[number]

export const themeStorageKey: string = 'displayTheme'

export class DisplayThemeResolver {
	static currentId(): ThemeId {
		const displayTheme = localStorage.getItem(themeStorageKey)

		if (!ThemeIds.includes(displayTheme)) return 'light'

		return displayTheme
	}

	static resolve(): DisplayTheme {
		return DisplayThemeResolver[DisplayThemeResolver.currentId()]()
	}

	static light() {
		return new LightGreyTheme()
	}

	static dark() {
		return new CyberneticTheme()
	}

	static dark2() {
		return new IndustrialTheme()
	}
}
