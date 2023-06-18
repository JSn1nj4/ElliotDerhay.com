<footer class="flex-initial border-t-4 border-solid border-seaGreen-900 dark:border-seaGreen-500">
	<div class="container-flexible-large w-full m-auto bottom-0 p-3">
		<div class="p-6 text-center text-seaGreen-900 dark:text-seaGreen-500">
			@include('partials.copyright')
		</div>
		<div class="p-6 pt-0 text-center text-seaGreen-900 dark:text-seaGreen-500">
			@include('partials.socials', [
				'classes' => 'text-2xl'
			])
		</div>
	</div>
</footer>
