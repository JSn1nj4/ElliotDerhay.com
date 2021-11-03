<template>
	<div :class="`${displayClass} w-full bg-gray-200 dark:bg-gray-900`">
		<div id="dnt-box" class="fixed bottom-0 left-0 z-30 border-solid border-t border-gray-500 dar:border-none bg-gray-200 dark:bg-gray-900 w-full p-8" ref="dntBox">
			<div class="flex container mx-auto">
				<div class="flex flex-grow h-full">
					<p class="p-4 m-2">Please confirm whether you would like to allow tracking cookies on this website, in accordance with its <a href="/privacy">privacy policy</a>.</p>
				</div>
				<div class="flex w-64">
					<button :class="`${btnClasses} bg-sea-green-500 dark:bg-sea-green-600 text-gray-100 dark:text-gray-900`" @click="allowTracker(true)">Allow</button>
					<button :class="`${btnClasses} bg-gray-400 dark:bg-gray-800 text-sea-green-600 dark:text-sea-green-500`" @click="allowTracker(false)">Deny</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data: () => ({
		'btnClasses': 'flex-1 p-4 m-2 font-bold',
		'boxHeight': 'auto',
		'displayClass': 'block',
	}),
	methods: {
		allowTracker(allow) {
			EventBus.$emit('allow_tracking', allow);
			document.cookie = 'GA_POPUP_INTERACTION=1';
			this.hide();
		},
		hide() {
			this.displayClass = 'hidden';
		}
	},
	beforeMount() {
		if(document.cookie.indexOf('GA_POPUP_INTERACTION=1') !== -1 && navigator.doNotTrack === '1') this.hide();
	},
}
</script>
