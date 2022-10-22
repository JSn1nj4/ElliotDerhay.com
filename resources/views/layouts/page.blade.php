@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@section('body')

	@component('partials.header')
		<x-nav>
			<x-nav-item name="home" icon="fas fa-home">Home</x-nav-item>
			@if(config('app.enable-blog'))
				<x-nav-item name="blog">Blog</x-nav-item>
			@endif
		</x-nav>
	@endcomponent

	<main class="bg-white dark:bg-black layer-shadow flex flex-col flex-grow">
		@yield('content')
	</main>

	@include('partials.footer')

@endsection

@push('footer-extras')
	<div id="ga-request-popup"></div>

	@vite('resources/js/app.ts')

	<script type="application/javascript">
		document.addEventListener('allow_tracking', ga_track);
	</script>
@endpush
