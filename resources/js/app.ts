import {DisplayModeController} from './appearance/DisplayModeController'
import {AnchorLinkController} from './controllers/AnchorLinkController'
import {PageMeasurementsModel} from './models/PageMeasurementsModel'
import {ScrollEffectsController} from './controllers/ScrollEffectsController'

// these have many of their own page registrations to worry about, including page load
PageMeasurementsModel.register()
ScrollEffectsController.init()

window.addEventListener('load', function () {
	// these must run after the other effects stuff is registered
	DisplayModeController.init()

	// these don't depend on anything and can run anytime
	AnchorLinkController.init()
})
