@extends('admin.layouts.page')

@section('page-title', 'Dashboard - ElliotDerhay.com')
@section('meta-description', '')

@section('content')
	<x-row flex-class="md:flex gap-6" :contained="false">
		<x-column class="block w-full">
			<div class="block md:grid grid-cols-2 pt-2">
				<div class="block">
					<h3 class="text-xl uppercase">Status</h3>
					<p class="text-xl">Users: {{ \App\Models\User::count() }}</p>
				</div>
				<div class="block">
					<h3 class="text-xl md:text-right">Welcome back, {{ auth()->user()->name }}</h3>
					<p class="text-xl md:text-right">Last login: {{
						\App\Models\Login::mostRecent()->long_date_at_time
					}}</p>
				</div>
			</div>
		</x-column>
	</x-row>
	<x-row flex-class="md:flex gap-6" :contained="false">
		<x-column class="w-full">
			<div class="grid grid-cols-1 gap-6">
				<x-admin.widgets.posts />
				<x-admin.widgets.projects />
				<x-admin.widgets.commands />
				<x-admin.widgets.command-log />
			</div>
		</x-column>
	</x-row>
@endsection
