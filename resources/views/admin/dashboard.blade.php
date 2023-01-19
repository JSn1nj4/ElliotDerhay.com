@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex gap-6">
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
	<x-row flex-class="md:flex gap-6">
		<x-sidebar>
			<div class="text-xl border-y-2 border-gray-700 h-full">
				<x-nav-item route="dashboard">Dashboard</x-nav-item>
				<x-nav-item route="posts.index">Posts</x-nav-item>
				<x-nav-item route="projects.index">Projects</x-nav-item>
				<x-nav-item route="commands.index">Commands</x-nav-item>
				<x-nav-item route="command-events.index">Command Log</x-nav-item>
			</div>
		</x-sidebar>
		<x-column class="w-full lg:w-2/3">
			<div class="grid grid-cols-1 gap-6">
				<x-admin.widgets.posts />
				<x-admin.widgets.projects />
				<x-admin.widgets.commands />
				<x-admin.widgets.command-log />
			</div>
		</x-column>
	</x-row>
@endsection
