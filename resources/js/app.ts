/**
 * Popup idea inspiration:
 * - https://kevdees.com/adding-google-analytics-to-your-website-while-respecting-do-not-track/
 */
import {createApp} from 'vue'
import Lightbox from './Lightbox.vue'
import Alpine from '@alpinejs/csp'

createApp(Lightbox).mount('#lightbox-modal')

window.Alpine = Alpine

Alpine.start()
