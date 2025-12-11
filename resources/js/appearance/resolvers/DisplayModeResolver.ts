import {SystemDisplayMode} from '../modes/SystemDisplayMode'
import {LightDisplayMode} from '../modes/LightDisplayMode'
import {DarkDisplayMode} from '../modes/DarkDisplayMode'
import type {DisplayMode} from '../modes/DisplayMode'

export const DisplayIds = ['system', 'light', 'dark']

type DisplayId = typeof DisplayIds[number]

export class DisplayModeResolver {
	static storageKey: 'theme'

	static currentId(): DisplayId {
		const displayMode = localStorage.getItem(DisplayModeResolver.storageKey)

		if (!DisplayIds.includes(displayMode)) return 'system'

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
