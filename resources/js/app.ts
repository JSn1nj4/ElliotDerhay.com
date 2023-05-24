/**
 * Popup idea inspiration:
 * - https://kevdees.com/adding-google-analytics-to-your-website-while-respecting-do-not-track/
 */
import { createApp } from "vue"
import GAPopup from "./GAPopup.vue"
import Lightbox from "./Lightbox.vue";

createApp(GAPopup).mount("#ga-request-popup")
createApp(Lightbox).mount("#lightbox-modal")
