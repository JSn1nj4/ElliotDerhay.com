@extends('layouts.error', [
		'errorCode' => '404',
		'errorTitle' => (isset($exception) && $exception !== '' && $exception->getMessage() !== '' && config('app.env') !== 'production') ? $exception->getMessage() : 'Not Found'
])

@section('status-body')
	<p>
		The page you were looking for may be missing. Please try finding it again, starting from the
		homepage.
	</p>
@endsection

@section('status-footer')
	<p>
		<a class="text-black dark:text-white hover:text-bright-turquoise-500" href="{{ route('home') }}">
			<x-fas-caret-square-left class='text-bright-turquoise-500 size-5 inline-block align-middle' />
			<span class='align-middle'>Back to homepage</span>
		</a>
	</p>
	<div class="pt-8 font-normal text-neutral-500">
		@include('partials.copyright')
	</div>
	<div class="pt-4">
		@include('partials.socials')
	</div>
@endsection
