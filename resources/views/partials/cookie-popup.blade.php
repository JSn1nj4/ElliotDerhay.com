<script type='application/javascript'>
	document.addEventListener('alpine:init', () => {
		Alpine.data('googleAnalytics', () => ({
			btnClasses: 'flex-1 p-4 m-2 font-bold',
			displayClass: 'block',

			disableTracking(e) {
				this.allowTracker(false)
			},

			enableTracking(e) {
				this.allowTracker(true)
			},

			allowTracker(allow) {
				if (typeof allow !== 'boolean') allow = false

				let now = new Date()
				now.setTime(now.getTime() + 1000 * 60 * 60 * 24 * 400)

				document.dispatchEvent(
					new CustomEvent('allow_tracking', {
						detail: {
							allow,
							time: now,
						},
					}),
				)

				document.cookie = 'GA_POPUP_INTERACTION=1;expires=' + now.toUTCString()
				this.hide()
			},

			hide() {
				this.displayClass = 'hidden'
			},

			init() {
				// Popup has been interacted with
				if (document.cookie.indexOf('GA_POPUP_INTERACTION=1') !== -1)
					this.hide()

				// "Do Not Track" enabled
				if (navigator.doNotTrack === '1') this.hide()
			},
		}))
	})
</script>

<div x-data='googleAnalytics'>
	<div class="w-full bg-neutral-200 dark:bg-neutral-900" :class='displayClass'>
		<div id="dnt-box"
				 class="fixed bottom-0 left-0 z-30 border-solid border-t border-neutral-500 dar:border-none bg-neutral-200 dark:bg-neutral-900 w-full p-4 md:p-8 text-xl md:text-base"
				 ref="dntBox">
			<div class="flex flex-col md:flex-row container mx-auto">
				<div class="flex flex-grow md:h-full">
					<p class="pb-4 md:p-4 mx-2 md:my-2">Please confirm whether you would like to allow tracking cookies on this
						website, in accordance with its <a href="/privacy">privacy policy</a>.</p>
				</div>
				<div class="flex md:w-64">
					<button
						class="bg-caribbeanGreen-500 dark:bg-caribbeanGreen-600 text-neutral-100 dark:text-neutral-900"
						:class='btnClasses'
						@click="enableTracking">Allow
					</button>
					<button
						class="bg-neutral-400 dark:bg-neutral-800 text-caribbeanGreen-600 dark:text-caribbeanGreen-500"
						:class='btnClasses'
						@click="disableTracking">Deny
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
