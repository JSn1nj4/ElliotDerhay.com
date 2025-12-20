import {ThemeId} from '../appearance/resolvers/DisplayThemeResolver'
import {ModeId} from '../appearance/resolvers/DisplayModeResolver'
import {DisplayModeUpdated} from './DisplayModeUpdated'
import {DisplayModeUpdateRequested} from './DisplayModeUpdateRequested'
import {DisplayThemeUpdated} from './DisplayThemeUpdated'
import {DisplayThemeUpdateRequested} from './DisplayThemeUpdateRequested'

export type DisplayEvent = (Event & {theme: ThemeId}) | (Event & {mode: ModeId})

const events = [
	DisplayModeUpdated,
	DisplayModeUpdateRequested,
	DisplayThemeUpdated,
	DisplayThemeUpdateRequested,
] as const

export type EventName = typeof events[number]['name']

type DisplayEventList = {
	[key in EventName]: (value: ModeId | ThemeId) => DisplayEvent
}

export class EventsRegistry {
	list: DisplayEventList

	constructor() {
		this.list = {
			[DisplayModeUpdated.name]: (value: ModeId) =>
				new DisplayModeUpdated(value),
			[DisplayModeUpdateRequested.name]: (value: ModeId) =>
				new DisplayModeUpdateRequested(value),
			[DisplayThemeUpdated.name]: (value: ThemeId) =>
				new DisplayThemeUpdated(value),
			[DisplayThemeUpdateRequested.name]: (value: ThemeId) =>
				new DisplayThemeUpdateRequested(value),
		}
	}

	static resolve(key: EventName): (value: string) => DisplayEvent {
		const registry = new EventsRegistry()

		return registry.resolve(key)
	}

	resolve(key: EventName): (value: string) => DisplayEvent {
		return this.list[key]
	}
}
