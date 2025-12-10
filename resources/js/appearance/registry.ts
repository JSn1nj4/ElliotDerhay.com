import {SystemDisplayMode} from './modes/SystemDisplayMode'
import {LightDisplayMode} from './modes/LightDisplayMode'
import {DarkDisplayMode} from './modes/DarkDisplayMode'
import {LightMetallicTheme} from './themes/LightMetallicTheme'
import {CyberneticTheme} from './themes/CyberneticTheme'
import {IndustrialTheme} from './themes/IndustrialTheme'

export const storageKeyId = 'storageKey'

export const displayModes = {
	[storageKeyId]: 'theme', // needs to be this, not displayMode, for cross-compatibility
	system: new SystemDisplayMode(),
	light: new LightDisplayMode(),
	dark: new DarkDisplayMode(),
}

export const displayThemes = {
	[storageKeyId]: 'displayTheme',
	light: new LightMetallicTheme(),
	dark: new CyberneticTheme(),
	dark2: new IndustrialTheme(),
}
