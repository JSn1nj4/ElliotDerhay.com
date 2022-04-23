<div class="max-w-sm m-auto mb-4" style="min-height: {{ $loaderSize }};">
	<x-timeline :show-line="false">
		@foreach ($events as $event)
			<x-github.event-wrapper :event="$event"/>
		@endforeach
	</x-timeline>
</div>
