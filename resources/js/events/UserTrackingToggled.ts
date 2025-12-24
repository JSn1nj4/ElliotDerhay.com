export class UserTrackingToggled extends Event {
	static readonly name: string = 'user_tracking.toggled'

	allow: boolean

	time: Date

	constructor(allow: boolean, time: Date) {
		super(UserTrackingToggled.name, {bubbles: true, cancelable: true})

		this.allow = allow
		this.time = time
	}
}
