@extends('admin.layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@section('body')
	@component('partials.header')
		<x-nav>
			<x-nav-item name="dashboard">Dashboard</x-nav-item>
			<x-nav-item name="logout" icon="fas fa-sign-out-alt">Log Out</x-nav-item>
		</x-nav>
	@endcomponent

	<main class="bg-white dark:bg-black layer-shadow flex flex-col flex-grow">
		@yield('content')
	</main>
@endsection
