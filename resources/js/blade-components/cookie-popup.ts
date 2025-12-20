import {UserTrackingToggled} from '../events/UserTrackingToggled'

// hack to make TS ok with using global Alpine loaded by Livewire
declare global {
	interface Window {
		Alpine: any
	}
}

window.Alpine.data('googleAnalytics', () => ({
	btnClasses: 'flex-1 p-2 font-bold',
	displayClass: 'block',

	disableTracking(e) {
		this.allowTracker(false)
	},

	enableTracking(e) {
		this.allowTracker(true)
	},

	allowTracker(allow: boolean) {
		if (typeof allow !== 'boolean') allow = false

		let now = new Date()
		now.setTime(now.getTime() + 1000 * 60 * 60 * 24 * 400)

		document.dispatchEvent(new UserTrackingToggled(allow, now))

		document.cookie = 'GA_POPUP_INTERACTION=1;expires=' + now.toUTCString()
		this.hide()
	},

	hide() {
		this.displayClass = 'hidden'
	},

	init() {
		// Popup has been interacted with
		if (document.cookie.indexOf('GA_POPUP_INTERACTION=1') !== -1) this.hide()

		// "Do Not Track" enabled
		if (navigator.doNotTrack === '1') this.hide()
	},
}))
