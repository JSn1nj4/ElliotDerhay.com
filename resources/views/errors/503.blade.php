@extends('layouts.error', [
		'errorCode' => '503',
		'errorTitle' => (isset($exception) && $exception !== '' && $exception->getMessage() !== '' && config('app.env') !== 'production') ? $exception->getMessage() : 'Service Unavailable'
])

@section('status-body')
		<p>
				This site is down for maintenance. Please check back later.
		</p>
@endsection
