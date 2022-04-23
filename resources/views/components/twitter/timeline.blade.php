<div class="max-w-sm m-auto mb-4" style="min-height: {{ $loaderSize }};">
	<x-timeline :show-line="$count >= 2">
		@each('partials.twitter.card', $tweets, 'tweet')
	</x-timeline>
</div>
