<div x-data='googleAnalytics'>
	<div class="w-full bg-big-stone-200 dark:bg-big-stone-950" :class='displayClass'>
		<div id="dnt-box"
				 class="fixed bottom-0 left-0 z-30 border-solid border-t border-slate-500 dark:border-bright-turquoise-700 dark2:border-slate-800 bg-big-stone-200 dark:bg-big-stone-950 dark2:bg-slate-800 w-full text-xl md:text-base"
				 ref="dntBox">
			<div class='w-full h-full dark:bg-black/70 dark2:bg-transparent p-4'>
				<div class="flex flex-col md:flex-row container mx-auto">
					<div class="flex grow md:h-full">
						<p class="pb-2 md:p-2">Please confirm whether you would like to allow tracking cookies on this
							website, in accordance with its <a href="/privacy">privacy policy</a>.</p>
					</div>
					<div class="flex md:w-48 gap-4">
						<button
							class="bg-bright-turquoise-500 dark:bg-bright-turquoise-600 text-big-stone-100 dark:text-slate-950 flex-1 p-2 font-bold"
							@click="enableTracking">
							Allow
						</button>
						<button
							class="bg-slate-100 dark:bg-slate-800 dark2:bg-slate-700 text-bright-turquoise-600 dark:text-bright-turquoise-500 flex-1 p-2 font-bold"
							@click="disableTracking">
							Deny
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@vite('resources/js/blade-components/cookie-popup.ts')
