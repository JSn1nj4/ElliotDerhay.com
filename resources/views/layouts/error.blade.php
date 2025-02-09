@extends('layouts.splash', ['bodyClasses' => 'status-page backlight'])

@section('content')
	<div class="flex flex-col mx-auto container px-4 py-6 pt-16 sm:pt-32 md:pt-48 xl:pt-56 justify-center">
		<div class="pb-4 w-full max-w-md mx-auto">
			<h1 class="text-xl sm:text-4xl">
				<span class="align-middle text-3xl sm:text-6xl font-extralight">{{ $errorCode }}</span>
				<span class="inline-block align-middle w-0 h-10 sm:h-16 border-solid border-r-2 border-caribbeanGreen-500">&nbsp;</span>
				<span class="align-middle leading-none">{{ $errorTitle }}</span>
			</h1>

			<div class="pt-4 text-md sm:text-lg leading-normal font-extralight">
				@yield('status-body')
			</div>

			<div class="pt-4">
				@yield('status-footer')
			</div>
		</div>
	</div>
@endsection
