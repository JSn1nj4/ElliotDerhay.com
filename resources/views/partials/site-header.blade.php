@extends('layouts.header', [
	'classes' => 'container-flexible-large'
])

@section('header-content')

	<div class="flex items-center flex-shrink-0 text-white">
		<a href="/" class="text-white p-2">
			<img src="{{ asset_url("avatar.png") }}" width="60" height="60" alt="ElliotDerhay.com logo" title="Elliot Derhay" class="inline border-solid border-2 border-white rounded-full align-middle">
			<span class="text-xl sm:text-3xl tracking-tighter py-px2 pl-2 align-middle">
				Elliot Derhay
			</span>
		</a>
	</div>

	<div class="block lg:hidden mr-5">
		<label for="menu-toggle" class="flex items-center text-sea-green-500 hover:text-white">
			<svg class="fill-current h-8 w-8" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
		</label>
	</div>

	<input type="checkbox" id="menu-toggle" name="menu-toggle" class="hidden absolute top-0 left-0 -z-50">

	<div class="w-full block absolute lg:relative flex-grow lg:flex lg:items-center lg:w-auto text-center lg:text-right text-xl mobile-menu">
		<div class="text-md lg:flex-grow">

			@foreach ($menuItems as $key => $item)
				<a href="{{ route($item->name, [], false) }}"
				class="block lg:inline-block px-4 py-6 uppercase{{ Route::currentRouteName() === $item->name ? ' active' : '' }}">
					@if(isset($item->icon))
						<i class="{{$item->icon}}"></i>
					@endif
					{{ $item->label }}
				</a>
			@endforeach

		</div>
	</div>

@endsection
