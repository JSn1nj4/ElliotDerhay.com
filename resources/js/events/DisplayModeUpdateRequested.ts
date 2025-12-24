import {ModeId} from '../appearance/resolvers/DisplayModeResolver'

export class DisplayModeUpdateRequested extends Event {
	static readonly name = 'display_mode.update_requested'

	mode: ModeId

	constructor(mode: ModeId) {
		super(DisplayModeUpdateRequested.name, {bubbles: true, cancelable: true})

		this.mode = mode
	}
}
