@extends('layouts.page', ['bodyClasses' => $bodyClasses ?? ''])

@section('content')
	<x-row flex-class="lg:flex">
		<x-column id="blog" class="flex-1 pr-8 last:pr-0 pb-12 lg:pb-0">
			@yield('blog')
		</x-column>

		@hasSection('sidebar')
			<x-sidebar>
				@yield('sidebar')
			</x-sidebar>
		@endif
	</x-row>
@endsection
