<root>
	<x-row flex-class="flex flex-col lg:flex-row gap-12">
		<x-column id="blog" class="only:w-full lg:w-2/3">
			{{ $slot }}
		</x-column>

		@isset($sidebar)
			<x-sidebar>
				{{ $sidebar }}
			</x-sidebar>
		@endisset
	</x-row>
</root>
