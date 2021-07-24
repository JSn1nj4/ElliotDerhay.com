<section {{ isset($id) ? "id=\"{$id}\"" : "" }} class="pt-4 pb-10 {{ $class }}">
	<div class="container mx-auto px-4 pt-6">
		<section class="block {{ $flex ? 'md:flex' : '' }}">

			{{ $slot }}

		</section>
	</div>
</section>
