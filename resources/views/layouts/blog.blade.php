@extends('layouts.page', ['bodyClasses' => $bodyClasses ?? ''])

@section('content')
	<x-row>
		<x-column id="blog" class="flex-grow">
			@yield('blog')
		</x-column>

		@hasSection('sidebar')
			<x-sidebar>
				@yield('sidebar')
			</x-sidebar>
		@endif
	</x-row>
@endsection
