<x-admin.widget>
	<x-slot:title>
		Posts
	</x-slot:title>

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
</x-admin.widget>
