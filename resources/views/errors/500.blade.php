@extends('layouts.error', [
		'errorCode' => '500',
		'errorTitle' => (isset($exception) && $exception !== '' && $exception->getMessage() !== '' && config('app.env') !== 'production') ? $exception->getMessage() : 'Internal Server Error'
])

@section('status-body')
	<p>
		Something went wrong. If this issue persists, please contact me via <a class="font-normal"
																																					 href="https://x.com/JSn1nj4">Twitter/X</a>.
	</p>
@endsection

@section('status-footer')
	<p>
		<a class="text-black dark:text-white hover:text-bright-turquoise-500" href="{{ route('home') }}">
			<x-fas-caret-square-left class='text-bright-turquoise-500 size-5 inline-block align-middle' />
			<span class='align-middle'>Back to homepage</span>
		</a>
	</p>
@endsection
