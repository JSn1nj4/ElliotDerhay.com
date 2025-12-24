import {
	DisplayEvent,
	DisplayEventsRegistry,
	EventName,
} from '../../events/DisplayEventsRegistry'

// hack to make TS ok with using global Alpine loaded by Livewire
declare global {
	interface Window {
		Alpine: any
	}
}

window.Alpine.data(
	'selectList',
	(key: 'mode' | 'theme', dispatch: EventName, listen: EventName) => ({
		key: key,
		dispatch: dispatch,
		listen: listen,
		value: '',

		init() {
			if (this.listen.length === 0) {
				return
			}

			document.addEventListener(this.listen, this.receive.bind(this))
		},

		send() {
			if (
				this.key.length === 0 ||
				this.dispatch.length === 0 ||
				this.value.length === 0
			) {
				return
			}

			document.dispatchEvent(
				DisplayEventsRegistry.resolve(this.dispatch)(this.value),
			)
		},

		receive(event: DisplayEvent) {
			if (this.key.length === 0) return

			const value = event[this.key]

			if (typeof value !== 'string' || value.length === 0) {
				return
			}

			this.value = value
		},
	}),
)
