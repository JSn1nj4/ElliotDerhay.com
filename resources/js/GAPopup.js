/**
 * Popup idea inspiration:
 * - https://kevdees.com/adding-google-analytics-to-your-website-while-respecting-do-not-track/
 */
import { createApp } from 'vue';
import GAPopup from './GAPopup.vue';

// GAPopup.mount("#ga-request-popup");

createApp(GAPopup).mount("#ga-request-popup");

// const GAPopupWidget = new Vue({
// 	el: '#ga-request-popup',
// 	render: h => h(GAPopup)
// });
