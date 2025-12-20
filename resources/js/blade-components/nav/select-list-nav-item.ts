import {Alpine} from '../../../../vendor/livewire/livewire/dist/livewire.esm'
import {
	DisplayEvent,
	EventName,
	EventsRegistry,
} from '../../events/EventsRegistry'

Alpine.data(
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

			document.dispatchEvent(EventsRegistry.resolve(this.dispatch)(this.value))
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

Alpine.start()
