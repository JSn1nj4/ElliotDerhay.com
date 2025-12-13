import {DisplayModeController} from './appearance/DisplayModeController'

window.addEventListener('load', function () {
	const controller = new DisplayModeController()
	controller.init()
})
