@extends('layouts.page')

@section('page-title', 'Log in - ElliotDerhay.com')
@section('meta-description', 'Log into the dashboard')

@section('content')
	<form class="mx-auto my-6 border-2 border-solid border-neutral-700 rounded-md bg-white bg-opacity-5 max-w-xs p-8" action="{{ route('login.attempt') }}" method="POST">
		@csrf
		<p><label for="email" class="text-lg mb-2">Email Address</label><input id="email" class="bg-neutral-900 w-full p-3 mb-4 text-base" type="email" name="email" placeholder="email@example.com" value="{{ old('email') }}"></p>
		<p><label for="password" class="text-lg mb-2">Password</label><input id="password" class="bg-neutral-900 w-full p-3 mb-4 text-base" type="password" name="password"></p>
		<p class="flex">
			<span class="flex-initial">
				@component('partials.button', ['type' => 'submit'])
					Submit
				@endcomponent
			</span>
			<span class="text-right flex-grow py-3 border-transparent border-solid border border-r-0"><a href="javascript:void(0)">Forgot Password</a></span>
		</p>
	</form>
	<div class="mx-auto my-6 border-2 border-solid border-transparent max-w-xs">
		@error('login')
			<p class="border-red-500 border-2 border-solid rounded p-2 text-red-500">{{ $message }}</p>
		@enderror
	</div>
@endsection
