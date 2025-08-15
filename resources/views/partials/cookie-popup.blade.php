<script type='application/javascript'>
	document.addEventListener('alpine:init', () => {
		Alpine.data('googleAnalytics', () => ({
			btnClasses: 'flex-1 p-2 font-bold',
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
				 class="fixed bottom-0 left-0 z-30 border-solid border-t border-neutral-500 dark:border-none bg-neutral-200 dark:bg-neutral-900 w-full p-4 text-xl md:text-base"
				 ref="dntBox">
			<div class="flex flex-col md:flex-row container mx-auto">
				<div class="flex grow md:h-full">
					<p class="pb-2 md:p-2">Please confirm whether you would like to allow tracking cookies on this
						website, in accordance with its <a href="/privacy">privacy policy</a>.</p>
				</div>
				<div class="flex md:w-48 gap-4">
					<button
						class="bg-caribbean-green-500 dark:bg-caribbean-green-600 text-neutral-100 dark:text-neutral-900"
						:class='btnClasses'
						@click="enableTracking">
						Allow
					</button>
					<button
						class="bg-neutral-400 dark:bg-neutral-800 text-caribbean-green-600 dark:text-caribbean-green-500"
						:class='btnClasses'
						@click="disableTracking">
						Deny
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
