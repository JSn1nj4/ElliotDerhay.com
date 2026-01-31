import {DisplayModeController} from './appearance/DisplayModeController'
import {AnchorLinkController} from './controllers/AnchorLinkController'
import {PageMeasurementsModel} from './models/PageMeasurementsModel'
import {ScrollEffectsController} from './controllers/ScrollEffectsController'
import {WheelSizeModel} from './models/WheelSizeModel'

// these have many of their own page registrations to worry about, including page load
PageMeasurementsModel.register()
WheelSizeModel.register() // added as a backup in case of base font size being changed
ScrollEffectsController.init()

// helpers to prevent flashing
document.addEventListener('livewire:navigate', () => {
	document.body.classList.add('navigating')
})
document.addEventListener('livewire:navigated', () => {
	setTimeout(() => {
		document.body.classList.remove('navigating')
	}, 300)
})

window.addEventListener('load', function () {
	// these must run after the other effects stuff is registered
	DisplayModeController.init()

	// these don't depend on anything and can run anytime
	AnchorLinkController.init()
})
