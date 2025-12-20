import {ModeId} from '../appearance/resolvers/DisplayModeResolver'

export class DisplayModeUpdated extends Event {
	static readonly name = 'display_mode.updated'

	mode: ModeId

	constructor(mode: ModeId) {
		super(DisplayModeUpdated.name, {bubbles: true, cancelable: true})

		this.mode = mode
	}
}
