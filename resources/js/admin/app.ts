import {createApp} from 'vue'
import Lightbox from '../Lightbox.vue'
import {DirtyStatesRegister} from './DirtyStatesRegister'

if (document.getElementById('lightbox-modal')) {
	createApp(Lightbox).mount('#lightbox-modal')
}

new DirtyStatesRegister()
