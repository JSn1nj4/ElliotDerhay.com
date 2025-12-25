<?php

use Livewire\Volt\Component;

new class extends Component {
	public int $speed;
	public string $timing;
	public bool $transition;

	public function mount()
	{
		$this->speed = 200;
		$this->timing = 'linear';
	}
}; ?>

<div>
	<section
		x-cloak
		x-data="lightbox({{ $speed }})"
		class="lightbox overlay fixed transition-opacity bg-black/50 w-full h-screen top-0"
		:class="{
			'z-50': front,
			'-z-50': !front,
			'opacity-0': !visible,
		}"
		:style="{
			'transition-duration': `${speed}ms`,
			'transition-timing-function': $wire.timing,
		}"
	>
		<button @click="maybeClose()" class="absolute top-2 right-4 text-4xl text-white z-50">&times;</button>
		<div class="relative h-screen object-contain flex flex-col items-center px-12 md:px-16 py-12 md:py-8">
			{{--	START: captionable image	--}}
			<figure class="relative block overflow-hidden rounded-lg object-contain w-fit max-w-full h-full">
				<img
					class="relative mx-auto object-contain w-full h-full"
					:src="image.src"
					:alt="image.alt"
					:title="image.title"
					:srcset="image.srcset"
				>
				<figcaption
					x-show="image.caption"
					class="caption absolute bottom-0 left-0 block p-4 w-full text-center bg-black/30"
					x-text="image.caption"
				></figcaption>
			</figure>
			{{--	END: captionable image	--}}
		</div>
	</section>
	@vite('resources/js/livewire-components/lightbox.ts')
</div>
