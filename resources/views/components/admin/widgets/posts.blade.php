<x-admin.widgets.wrapper>
	<x-slot:header>
		<x-admin.widgets.partials.title>
			Posts
		</x-admin.widgets.partials.title>
		<x-admin.widgets.partials.button href="{{ route('posts.index') }}">
			Manage
		</x-admin.widgets.partials.button>
	</x-slot:header>

	<table class="w-full mt-4">
		<thead>
			<tr>
				<th class="text-left mr-4 pb-2">Title</th>
				<th class="text-right">Date</th>
			</tr>
		</thead>
		<tbody>
			@foreach($posts as $post)
			<tr>
				<td class="text-left mr-4 py-2">{{ $post->title }}</td>
				<td class="text-right">{{ $post->created_at->format('d M Y') }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</x-admin.widgets.wrapper>
