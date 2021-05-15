@extends('layouts.error', [
		'errorCode' => '404',
		'errorTitle' => (isset($exception) && $exception !== '' && $exception->getMessage() !== '' && config('app.env') !== 'production') ? $exception->getMessage() : 'Not Found'
])

@section('status-body')
		<p>
				We're sorry, but the resource you were looking for seems to be missing. Please try finding it again, starting from the homepage.
		</p>
@endsection

@section('status-footer')
		<p>
				<a class="text-white hover:text-sea-green-500" href="{{ route('home') }}"><i class="text-sea-green-500 fa fa-caret-square-left"></i> Back to homepage</a>
		</p>
		<div class="pt-8 font-normal text-gray-500">
			@include('partials.copyright')
		</div>
		<div class="pt-4">
			@include('partials.socials', [
				'classes' => 'text-2xl'
			])
		</div>
@endsection
