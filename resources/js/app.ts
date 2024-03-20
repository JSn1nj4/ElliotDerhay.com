/**
 * Popup idea inspiration:
 * - https://kevdees.com/adding-google-analytics-to-your-website-while-respecting-do-not-track/
 */
import Alpine from '@alpinejs/csp'

// convince TS that adding new stuff to `window` is ok
declare global {
	interface Window {
		Alpine: any
	}
}

window.Alpine = Alpine || {}

Alpine.start()
