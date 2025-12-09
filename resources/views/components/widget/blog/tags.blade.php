@php /** @var \App\Models\Tag[] $tags */ @endphp
<x-widget.wrapper title="Tags">
	@foreach ($tags as $tag)
		<span
			class='inline-block lg:inline m-1 lg:m-0 border border-slate-600 lg:border-0 rounded lg:rounded-none bg-neutral-950 lg:bg-transparent px-2 py-1 lg:p-0'>
		<a href="{{ route('blog', compact('tag')) }}">
			#{{ $tag->title }}
		</a>
	</span>
		<span class="hidden lg:last:hidden">, </span>
	@endforeach
</x-widget.wrapper>
