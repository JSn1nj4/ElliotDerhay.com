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
			<table class="w-full border-collapse table-auto bg-gray-800 rounded-lg">
				<thead class="table-header-group">
					<tr class="table-row text-left border-b border-gray-600">
						<th class="table-cell text-2xl uppercase p-6">Title</th>
						<th class="table-cell text-2xl uppercase p-6">Date</th>
						<th class="table-cell text-2xl uppercase text-right p-6">
							<a class="px-6 py-1 dark:hover:bg-sea-green-500/20 dark:transition-colors duration-300 outline outline-1" href="{{ route('posts.create') }}">New</a>
						</th>
					</tr>
				</thead>
				<tbody class="table-row-group">
					@foreach($posts as $post)
					<tr class="table-row bg-sea-green-800/20 even:bg-sea-green-800/10">
						<td class="table-cell p-6 text-xl">
							<a class="dark:transition-colors duration-300" href="{{ route('posts.edit', compact('post')) }}">
								{{ $post->title }}
							</a></td>
						<td class="table-cell p-6 text-xl">
							{{ $post->created_at->format('M d Y \a\t H:i') }}
						</td>
						<td class="table-cell p-6 text-xl text-right">
							<a class="px-6 py-1 dark:hover:bg-sea-green-500/20 dark:transition-colors duration-300 outline outline-1" href="{{ route('posts.edit', compact('post')) }}">Edit</a>
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot class="table-footer-group">
					<tr class="table-row border-t border-gray-600">
						<td class="table-cell p-6" colspan="3">
							{{ $posts->links() }}
						</td>
					</tr>
				</tfoot>
			</table>
		</x-column>
	</x-row>
@endsection
