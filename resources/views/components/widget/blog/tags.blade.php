@php/** @var \App\Models\Tag[] $tags */@endphp
<div>
	@foreach ($tags as $tag)
		<span>
			<a href="{{ route('blog', compact('tag')) }}">
				#{{ $tag->title }}
			</a>
		</span>
		<span class="last:hidden">, </span>
	@endforeach
</div>
