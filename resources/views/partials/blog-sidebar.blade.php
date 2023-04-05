@if(config('blog.feature.categories_widget'))
	<x-widget.wrapper title="Categories">
		<x-widget.blog.categories display="list"/>
	</x-widget.wrapper>
@endif

@if(config('blog.feature.tags_widget'))
	<x-widget.wrapper title="Tags">
		<x-widget.blog.tags sort-by="count" limit="10"/>
	</x-widget.wrapper>
@endif

@feature(\App\Features\TwitterFeed::class)
	<x-widget.wrapper title="Latest Tweet">
		<x-twitter.timeline count="1"/>
	</x-widget.wrapper>
@endfeature

@if(config('blog.feature.github_activity_widget'))
	<x-widget.wrapper title="GitHub Activity">
		<x-github.events-feed count="5"/>
	</x-widget.wrapper>
@endif
