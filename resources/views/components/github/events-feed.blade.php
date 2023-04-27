<div class="max-w-md m-auto mb-4" style="min-height: {{ $loaderSize }};">
	<x-timeline :show-line="false">
		@foreach ($events as $event)
			<x-github.event-wrapper :type="$type" :padding="$padding" :event="$event"/>
		@endforeach
	</x-timeline>
</div>
