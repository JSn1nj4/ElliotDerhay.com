/**
 * Popup idea inspiration:
 * - https://kevdees.com/adding-google-analytics-to-your-website-while-respecting-do-not-track/
 */

import GAPopup from './GAPopup.vue';

const GAPopupWidget = new Vue({
	el: '#ga-request-popup',
	render: h => h(GAPopup)
});
