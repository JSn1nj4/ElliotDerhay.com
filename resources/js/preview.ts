import {DisplayModeController} from './appearance/DisplayModeController'
import {AnchorLinkController} from './controllers/AnchorLinkController'

// helpers to prevent flashing
document.addEventListener('livewire:navigate', () => {
	document.documentElement.classList.add('navigating')
})
document.addEventListener('livewire:navigated', () => {
	setTimeout(() => {
		document.documentElement.classList.remove('navigating')
	}, 300)
})

window.addEventListener('load', function () {
	// these must run after the other effects stuff is registered
	DisplayModeController.init()

	// these don't depend on anything and can run anytime
	AnchorLinkController.init()
})
