import {LightboxData} from '../livewire-components/lightbox'

export class LightboxCandidateClicked extends Event {
	static readonly name = 'lightbox_candidate.clicked'

	data: LightboxData

	constructor(data: LightboxData) {
		super(LightboxCandidateClicked.name, {bubbles: true, cancelable: true})

		this.data = data
	}
}
