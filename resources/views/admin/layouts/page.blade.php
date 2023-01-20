@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@section('body')
	@component('partials.header')
		<x-nav>
			<x-nav-item route="logout" inline icon="fas fa-sign-out-alt" onclick="event.preventDefault(); document.querySelector('#logout').submit();">Log Out</x-nav-item>
		</x-nav>

		<form id="logout" method="POST" action="{{ route('logout') }}" class="-z-50 absolute top-0 left-0">
			@csrf
		</form>
	@endcomponent

	<main class="bg-white dark:bg-black layer-shadow flex flex-row flex-grow">
		<x-sidebar width-classes="md:w-1/3 lg:w-1/4 xl:w-1/5">
			<x-row flex-class="md:flex gap-6">
				<x-column class="block w-full">
					<div class="text-xl">
						<x-nav-item route="dashboard">Dashboard</x-nav-item>
						<x-nav-item route="posts.index">Posts</x-nav-item>
						<x-nav-item route="projects.index">Projects</x-nav-item>
						<x-nav-item route="commands.index">Commands</x-nav-item>
						<x-nav-item route="command-events.index">Command Log</x-nav-item>
					</div>
				</x-column>
			</x-row>
		</x-sidebar>

		<x-column class="w-full md:w-2/3 lg:w-3/4 xl:w-4/5 border-l-2 border-gray-400 dark:border-gray-800">
			@yield('content')
		</x-column>
	</main>
@endsection

@push('footer-extras')
	@vite('resources/js/admin/app.ts')
@endpush
