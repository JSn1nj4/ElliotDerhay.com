@php
/**
 * @var App\Models\Post[] $posts
 * @var App\Models\Post $post
 */
@endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="null">
		<x-column class="block w-full">
			<h1 class="text-3xl uppercase mb-8">Posts</h1>
			<div class="px-6 pb-6">
				{{ $posts->links() }}
			</div>
			<x-ui.table.wrapper>
				<x-ui.table.header>
					<x-ui.table.row class="border-b border-gray-600">
						<x-ui.table.heading>Title</x-ui.table.heading>
						<x-ui.table.heading>Date</x-ui.table.heading>
						<x-ui.table.heading class="text-right">
							<a class="px-3 py-1 dark:hover:bg-sea-green-500/20 dark:transition-colors duration-300 outline outline-1" href="{{ route('posts.create') }}" title="New Post"><i class="fas fa-plus"></i></a>
						</x-ui.table.heading>
					</x-ui.table.row>
				</x-ui.table.header>
				<x-ui.table.body>
					@foreach($posts as $post)
					<x-ui.table.row class="bg-sea-green-800/20 even:bg-sea-green-800/10">
						<x-ui.table.data>
							<a class="dark:transition-colors duration-300" href="{{ route('posts.edit', compact('post')) }}">{{ $post->title }}</a>
						</x-ui.table.data>
						<x-ui.table.data>
							{{ $post->created_at->format('M d Y \a\t H:i') }}
						</x-ui.table.data>
						<x-ui.table.data class="text-right">
							<a class="px-3 py-1 dark:hover:bg-sea-green-500/20 dark:transition-colors duration-300 outline outline-1" href="{{ route('posts.edit', compact('post')) }}" title="Edit Post"><i class="fas fa-pencil-alt"></i></a>
						</x-ui.table.data>
					</x-ui.table.row>
					@endforeach
				</x-ui.table.body>
				<x-ui.table.footer>
					<x-ui.table.row class="border-t border-gray-600">
						<x-ui.table.data colspan="3">
							{{ $posts->links() }}
						</x-ui.table.data>
					</x-ui.table.row>
				</x-ui.table.footer>
			</x-ui.table.wrapper>
		</x-column>
	</x-row>
@endsection
