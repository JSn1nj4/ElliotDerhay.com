<div>
	@foreach($tags as $tag)
		<span>
			<a href="/category/{{ $tag->slug }}">
				#{{ $tag->title }}
			</a>
		</span>
		<span class="last:hidden">, </span>
	@endforeach
</div>
