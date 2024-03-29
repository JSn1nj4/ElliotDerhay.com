<section {{ isset($id) ? "id={$id}" : "" }} class="relative {{ $class }}" style="background-image: url('{{ $backgroundImage }}')">
	@if ($overlayClasses)
		<div class="absolute block w-full h-full t-0 l-0 z-0 {{ $overlayClasses }}"></div>
	@endif
	<div class="{{ $contained ? 'container ' : '' }}relative mx-auto px-4 py-10 z-10">
		<section class="block {{ $flexClass ?? '' }}">

			{{ $slot }}

		</section>
	</div>
</section>
