@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@push('head-extras')
	<livewire:google-analytics />
@endpush

@section('body')

	@component('partials.header')
		<x-nav>
			@php /** @var \App\DataTransferObjects\NavItemDTO[] $navItems */ @endphp
			{{-- Injected via View Creator --}}
			@foreach($navItems as $navItem)
				<x-nav-item
					:route='$navItem->route'
					:icon='$navItem->icon'
					inline
					livewire
				>{{ $navItem->label }}</x-nav-item>
			@endforeach
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
