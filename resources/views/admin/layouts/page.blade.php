@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@section('body')
	@component('partials.header')
		<x-nav>
			<x-nav-item route="dashboard">Dashboard</x-nav-item>
			<x-nav-item route="posts.index">Posts</x-nav-item>
			<x-nav-item route="projects.index">Projects</x-nav-item>
			<x-nav-item route="logout" icon="fas fa-sign-out-alt" onclick="event.preventDefault(); document.querySelector('#logout').submit();">Log Out</x-nav-item>
		</x-nav>

		<form id="logout" method="POST" action="{{ route('logout') }}" class="-z-50 absolute top-0 left-0">
			@csrf
		</form>
	@endcomponent

	<main class="bg-white dark:bg-black layer-shadow flex flex-col flex-grow">
		@yield('content')
	</main>
@endsection

@push('footer-extras')
	@vite('resources/js/admin/app.ts')
@endpush
