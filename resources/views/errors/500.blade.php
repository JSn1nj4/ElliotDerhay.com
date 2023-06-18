@extends('layouts.error', [
		'errorCode' => '500',
		'errorTitle' => (isset($exception) && $exception !== '' && $exception->getMessage() !== '' && config('app.env') !== 'production') ? $exception->getMessage() : 'Internal Server Error'
])

@section('status-body')
		<p>
				Something went wrong on the back-end. If this issue persists, please contact me via <a class="font-normal" href="https://twitter.com/JSn1nj4">Twitter</a>.
		</p>
@endsection

@section('status-footer')
		<p>
				<a class="text-black dark:text-white hover:text-seaGreen-500" href="{{ route('home') }}"><i class="text-seaGreen-500 fa fa-caret-square-left"></i> Back to homepage</a>
		</p>
@endsection
