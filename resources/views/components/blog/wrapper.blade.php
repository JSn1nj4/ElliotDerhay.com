<root>
	<x-row flex-class="lg:flex">
		<x-column id="blog" class="pr-8 last:pr-0 pb-12 lg:pb-0 only:w-full lg:w-2/3">
			{{ $slot }}
		</x-column>

		@isset($sidebar)
			<x-sidebar>
				{{ $sidebar }}
			</x-sidebar>
		@endisset
	</x-row>
</root>
