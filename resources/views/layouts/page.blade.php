@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@section('head-extras')
	@yield('head-extras-pass-thru')
@endsection

@section('body')

	@php
		$menuItems = [
			(object) ['name' => 'home', 'label' => 'Home', 'icon' => 'fas fa-home'],
		];

		$optionalMenuItems = [
			(object) ['name' => 'projects', 'label' => 'Projects'],
			(object) ['name' => 'updates', 'label' => 'Updates'],
		];

		foreach($optionalMenuItems as $item) {
			if(config("app.enable-" . $item->name)) $menuItems[] = $item;
		}
	@endphp

	@include('layouts.header', $menuItems)

	<main class="bg-black layer-shadow flex-grow">
		@yield('content')
	</main>

	@include('layouts.footer')

@endsection

@section('footer-extras')
	<div id="ga-request-popup" style="display: none;"></div>

	<script src="{{ mix('/js/manifest.js') }}"></script>
	<script src="{{ mix('/js/vendor.js') }}"></script>
	<script src="{{ mix('/js/app.js') }}"></script>

	@yield('footer-extras-pass-thru')

	<script src="{{ mix('/js/GAPopup.js') }}" charset="utf-8"></script>

	<script type="application/javascript">
		EventBus.$on('allow_tracking', ga_track);
	</script>
@endsection
