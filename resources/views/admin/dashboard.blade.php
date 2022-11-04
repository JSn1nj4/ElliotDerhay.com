@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex gap-6">
		<x-column class="block w-full">
			<h3 class="text-xl uppercase">Status</h3>
			<div class="block md:grid grid-cols-2 pt-2">
				<p class="text-xl">Users: {{ \App\Models\User::count() }}</p>
				<p class="text-xl md:text-right">Last login: {{
    			\App\Models\Login::latest()
						->first()
						->created_at
						->toDayDateTimeString()
				}}</p>
			</div>
		</x-column>
	</x-row>
	<x-row flex-class="null">
		<div class="block md:grid grid-cols-2 gap-6">
			<x-admin.posts-widget/>
			<x-admin.widget>
				<x-slot:title>
					Projects
				</x-slot:title>
			</x-admin.widget>
		</div>
	</x-row>
@endsection
