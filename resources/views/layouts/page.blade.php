@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@section('body')

	@include('partials.header')

	<main class="bg-white dark:bg-black layer-shadow flex-grow">
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
