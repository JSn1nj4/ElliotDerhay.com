<div class="github-event-item">
	<x-card.wrapper size="md" :type="$type" :padding="$padding" margin="my-4">
		<x-dynamic-component :component="$eventTypeComponent" :event="$event"/>
	</x-card.wrapper>
</div>
