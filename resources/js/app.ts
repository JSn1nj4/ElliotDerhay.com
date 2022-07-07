/**
 * Popup idea inspiration:
 * - https://kevdees.com/adding-google-analytics-to-your-website-while-respecting-do-not-track/
 */
import { createApp } from "vue"
import GAPopup from "./GAPopup.vue"

createApp(GAPopup).mount("#ga-request-popup")
