import {DisplayModeController} from './appearance/DisplayModeController'
import {AnchorLinkController} from './controllers/AnchorLinkController'

window.addEventListener('load', function () {
	DisplayModeController.init()
	AnchorLinkController.init()
})
