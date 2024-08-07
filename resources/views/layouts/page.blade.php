@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@push('head-extras')
	<livewire:google-analytics />
@endpush

@section('body')

	@component('partials.header')
		<x-nav>
			<x-nav-item route="home" icon="fas fa-home" inline livewire>Home</x-nav-item>
			@if(config('app.enable-blog'))
				<x-nav-item route="blog" inline livewire>Blog</x-nav-item>
			@endif
			@if(config('app.enable-projects'))
				<x-nav-item route="portfolio" inline livewire>Projects</x-nav-item>
			@endif
		</x-nav>
	@endcomponent

	<main class="bg-white dark:bg-black layer-shadow flex flex-col flex-grow">
		@yield('content')
	</main>

	@include('partials.footer')
@endsection

@push('footer-extras')
	@vite('resources/js/app.ts')

	@include('partials.cookie-popup')
@endpush
