<template>
	<div class="loading-animation absolute top-0 left-0 w-full h-full"
		:class="[{ hide: isHidden }, zIndex]">
		<div class="loader-content mx-auto" :style="`max-width: ${this.size}`">
			<atom-spinner />
		</div>
	</div>
</template>
<script>
import AtomSpinner from './AtomSpinner.vue';
export default {
	name: "load-animation",

	props: {
		size: {
			type: String,
			default: '40px'
		}
	},

	components: {
		AtomSpinner,
	},

	data: () => ({
		isHidden: false,
		zIndex: 'z-50',
	}),

	methods: {
		/**
		 * @method fadeOut
		 *
		 * @return void
		 *
		 * @description This method is meant to be called by a parent
		 * component. The purpose is for the parent component to fade this
		 * component out when loading is complete.
		 */
		fadeOut() {
			this.isHidden = true;
			setTimeout(() => {
				this.zIndex = 'z-0';
			}, 1000);
		},

		/**
		 * @method fadeIn
		 * @return void
		 *
		 * @description This method fades the loader animation back in. This
		 * method may not be needed in the future. However, it's nice to
		 * have a way to undo the affects of the fadeOut method.
		 */
		fadeIn() {
			this.zIndex = 'z-50';
			this.isHidden = false;
		}
	}
}
</script>
<style>
.loading-animation {
	opacity: 1;
	transition: opacity 1s;
	background: rgba(21, 21, 21, 0.8);
}
.loading-animation.hide {
	opacity: 0;
}

/**
 * A new animation was necessary to override the colors since they were
 * being set by the animation that came with the Socket component.
 */
.hex-brick {
	animation-name: socket-fade !important;
}
@keyframes socket-fade {
	0% {
		background: #fff;
	}
	50% {
		background: #00c49a;
	}
	100% {
		background: #fff;
	}
}
</style>
