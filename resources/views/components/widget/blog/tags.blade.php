@php/** @var \App\Models\Tag[] $tags */@endphp
<div>
	@foreach
($tags as $tag)
		<span>
			<a href="/tag/{{ $tag->slug }}">
				#{{ $tag->title }}
			</a>
		</span>
		<span class="last:hidden">, </span>
	@endforeach
</div>
