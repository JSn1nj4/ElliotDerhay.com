<script type="application/ld+json">
	{
		"@@context": "http://schema.org",
	"@type": "{{ $type }}",
	"name": "{{ $name }}",
	"author": {
		"@type": "Person",
		"name": "Elliot Derhay",
	},
	"datePublished": "{{ $date }}",
	@isset($image)
		"image": "{{ $image }}",
	@endisset
	@isset($category)
		"articleSection": "{{ $category }}",
	@endisset
	"articleBody": "{{ $body }}"
}
</script>
