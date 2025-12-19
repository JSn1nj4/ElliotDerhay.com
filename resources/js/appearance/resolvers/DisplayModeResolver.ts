import {
	DarkDisplayMode,
	DisplayMode,
	LightDisplayMode,
	SystemDisplayMode,
} from '../DisplayModes'

export const ModeIds = ['system', 'light', 'dark']

type ModeId = typeof ModeIds[number]

export const modeStorageKey: string = 'theme'

export class DisplayModeResolver {
	static currentId(): ModeId {
		const displayMode = localStorage.getItem(modeStorageKey)

		if (!ModeIds.includes(displayMode)) return 'system'

		return displayMode
	}

	static prefersDark(): boolean {
		return window.matchMedia('(prefers-color-scheme: dark)').matches
	}

	static resolve(): DisplayMode {
		return DisplayModeResolver[DisplayModeResolver.currentId()]()
	}

	static system() {
		return new SystemDisplayMode()
	}

	static light() {
		return new LightDisplayMode()
	}

	static dark() {
		return new DarkDisplayMode()
	}
}
