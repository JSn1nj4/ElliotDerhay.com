export class UserTrackingToggled extends Event {
	static readonly name: string = 'allow_tracking'

	allow: boolean

	time: Date

	constructor(allow: boolean, time: Date) {
		super(UserTrackingToggled.name, {bubbles: true, cancelable: true})

		this.allow = allow
		this.time = time
	}
}
