@extends('layouts.error', [
		'errorCode' => '403',
		'errorTitle' => (isset($exception) && $exception !== '' && $exception->getMessage() !== '' && config('app.env') !== 'production') ? $exception->getMessage() : 'Forbidden'
])

@section('status-body')
		<p>
				Sorry, but you're not authorized to view this resource.
		</p>
@endsection

@section('status-footer')
		<p>
				<a class="text-black dark:text-white hover:text-sea-green-500" href="{{ route('home') }}"><i class="text-sea-green-500 fa fa-caret-square-left"></i> Back to homepage</a>
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
