@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@section('body')

	@include('partials.header')

	<main class="bg-white dark:bg-black layer-shadow flex-grow">
		@yield('content')
	</main>

	@include('partials.footer')

@endsection

@push('footer-extras')
	<div id="ga-request-popup" style="display: none;"></div>

	<script src="{{ mix('/js/manifest.js') }}"></script>
	<script src="{{ mix('/js/vendor.js') }}"></script>
	<script src="{{ mix('/js/app.js') }}"></script>

	<script src="{{ mix('/js/GAPopup.js') }}" charset="utf-8"></script>

	<script type="application/javascript">
		EventBus.$on('allow_tracking', ga_track);
	</script>
@endpush
