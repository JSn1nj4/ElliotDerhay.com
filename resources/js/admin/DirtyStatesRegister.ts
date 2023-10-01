import {BasicObject} from '../GeneralTypes'

export class DirtyStatesRegister {
	confirmEvents: string[] = []

	states: BasicObject<boolean> = {}

	constructor(events: string[] = []) {
		this.states = {}
		this.confirmEvents = ['beforeunload'].concat(events)

		this.confirmEvents.forEach(name =>
			window.addEventListener(name, this.triggerConfirm),
		)

		window.addEventListener('reportDirtyState', this.setState.bind(this))
		window.addEventListener('checkDirtyState', this.getState.bind(this))
		window.addEventListener('forgetDirtyState', this.unsetState.bind(this))

		console.info('Dirty States Register init')
	}

	get isClean(): boolean {
		return !Object.values(this.states).includes(true)
	}

	getState({
		target,
		detail: {hashVal, emitBack},
	}: {
		target: EventTarget
		detail: {
			hashVal: string
			emitBack: string
		}
	}): void {
		target.dispatchEvent(
			new CustomEvent(emitBack, {
				detail: {isDirty: this.states[hashVal]},
			}),
		)
	}

	setState({
		detail: {hashVal, isDirty},
	}: {
		detail: {
			hashVal: string
			isDirty: boolean
		}
	}): void {
		this.states[hashVal] = isDirty
	}

	unsetState({detail: {hashVal}}: {detail: {hashVal: string}}): void {
		delete this.states[hashVal]
	}

	triggerConfirm(e: Event): boolean {
		if (this.isClean) return true

		if (
			!window.confirm(
				'You have unsaved changes. Are you sure you want to leave?',
			)
		) {
			e.preventDefault()
			return false
		}
	}
}
