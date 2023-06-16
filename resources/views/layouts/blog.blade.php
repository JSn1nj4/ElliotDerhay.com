@extends('layouts.page', ['bodyClasses' => $bodyClasses ?? ''])

@section('content')
	<x-row flex-class="lg:flex">
		<x-column id="blog" class="pr-8 last:pr-0 pb-12 lg:pb-0 only:w-full lg:w-2/3">
			@yield('blog')
		</x-column>

		@hasSection('sidebar')
			<x-sidebar>
				@yield('sidebar')
			</x-sidebar>
		@endif
	</x-row>
@endsection
