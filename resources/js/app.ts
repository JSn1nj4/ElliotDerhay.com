import {DisplayModeController} from './appearance/DisplayModeController'
import {AnchorLinkController} from './controllers/AnchorLinkController'

window.addEventListener('load', function () {
	const controller = new DisplayModeController()
	controller.init()

	AnchorLinkController.init()
})
