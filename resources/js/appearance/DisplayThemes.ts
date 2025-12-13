import {
	DisplayThemeResolver,
	themeStorageKey,
} from './resolvers/DisplayThemeResolver'
import {DisplayModeResolver} from './resolvers/DisplayModeResolver'
import {LightDisplayMode} from './DisplayModes'

export class DisplayTheme {
	get id(): string {
		return 'light'
	}

	broadcast(value: string): this {
		document.dispatchEvent(
			new CustomEvent('display_theme.updated', {
				detail: {theme: value},
			}),
		)

		return this
	}

	init(): void {}

	isDark(): boolean {
		return false
	}

	toLightGreyTheme(): LightGreyTheme {
		const root = document.documentElement
		root.classList.remove('dark')
		root.classList.remove('dark2')

		return DisplayThemeResolver.light()
			.updateDocAttribute('light')
			.updateStorage('light')
			.broadcast('light')
	}

	toCyberneticTheme(): DisplayTheme {
		const root = document.documentElement
		if (root.classList.contains('dark2')) root.classList.remove('dark2')
		if (!root.classList.contains('dark')) root.classList.add('dark')

		return DisplayThemeResolver.dark()
			.updateDocAttribute('dark')
			.updateStorage('dark')
			.broadcast('dark')
	}

	toIndustrialTheme(): DisplayTheme {
		if (
			DisplayModeResolver.resolve() instanceof LightDisplayMode ||
			!DisplayModeResolver.prefersDark()
		) {
			return this
		}

		document.documentElement.classList.add('dark')
		document.documentElement.classList.add('dark2')

		return DisplayThemeResolver.dark2()
			.updateStorage('dark2')
			.broadcast('dark2')
	}

	toSystemAppropriate(): DisplayTheme {
		if (!DisplayModeResolver.prefersDark()) return this.toLightGreyTheme()

		if (!this.isDark()) return this.toCyberneticTheme()
	}

	updateDocAttribute(value: string): DisplayTheme {
		document.documentElement.setAttribute('color-theme', value)

		return this
	}

	updateStorage(value: string): DisplayTheme {
		localStorage.setItem(themeStorageKey, value)

		return this
	}
}

export class LightGreyTheme extends DisplayTheme {
	init(): void {
		this.updateStorage('light').broadcast('light')

		document.documentElement.classList.remove('dark')
		document.documentElement.classList.remove('dark2')
	}

	toLightGreyTheme(): LightGreyTheme {
		return this
	}
}

export class CyberneticTheme extends DisplayTheme {
	init(): void {
		this.updateStorage('dark').broadcast('dark')

		document.documentElement.classList.add('dark')
		document.documentElement.classList.remove('dark2')
	}

	isDark(): boolean {
		return true
	}

	toCyberneticTheme(): CyberneticTheme {
		return this
	}
}

export class IndustrialTheme extends DisplayTheme {
	init(): void {
		this.updateStorage('dark2').broadcast('dark2')

		document.documentElement.classList.add('dark')
		document.documentElement.classList.add('dark2')
	}

	isDark(): boolean {
		return true
	}

	toIndustrialTheme(): IndustrialTheme {
		return this
	}
}
