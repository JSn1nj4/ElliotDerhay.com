@extends('layouts.error', [
		'errorCode' => '403',
		'errorTitle' => (isset($exception) && $exception !== '' && $exception->getMessage() !== '' && config('app.env') !== 'production') ? $exception->getMessage() : 'Forbidden'
])

@section('status-body')
	<p>
		Sorry, but you're not authorized to view this.
	</p>
@endsection

@section('status-footer')
	<p>
		<a class="text-black dark:text-white hover:text-caribbeanGreen-500" href="{{ route('home') }}"><i
				class="text-caribbeanGreen-500 fa fa-caret-square-left"></i> Back to homepage</a>
	</p>
	<div class="pt-8 font-normal text-neutral-500">
		@include('partials.copyright')
	</div>
	<div class="pt-4">
		@include('partials.socials', [
			'classes' => 'text-2xl'
		])
	</div>
@endsection
