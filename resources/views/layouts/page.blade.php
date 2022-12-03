@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@push('head-extras')
	@include('partials.trackers')
@endpush

@section('body')

	@component('partials.header')
		<x-nav>
			<x-nav-item route="home" icon="fas fa-home">Home</x-nav-item>
			@if(config('app.enable-blog'))
				<x-nav-item route="blog">Blog</x-nav-item>
			@endif
			@if(config('app.enable-projects'))
				<x-nav-item route="portfolio">Projects</x-nav-item>
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
