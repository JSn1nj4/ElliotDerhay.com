<?php

use Livewire\Volt\Component;

new class extends Component {
	//
}; ?>

<x-slot:title>Additional Credits - {{ config('app.name') }}</x-slot:title>
<x-slot:meta-description>
	This page exists to credit others whose work I on my site.
</x-slot:meta-description>
<root>
	<x-row class="my-12" flex-class="flex-none">
		<x-column class="w-full flex flex-col gap-8">
			<section class='w-full flex flex-col gap-2'>
				<h1 class='text-4xl'>Additional Credits</h1>
				<p>When I use a stock photo or graphic in the header of my blog post, I include the credits there. But some
					pieces, such as background images, are harder to credit directly the same way. This page exists to fill that
					gap.</p>
			</section>
		</x-column>
	</x-row>

	<x-row class="my-12" flex-class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
		<x-column class='flex flex-col gap-6'>
			<section class='w-full flex flex-col gap-2 text-center'>
				<x-media.captionable-image :src="asset_url('credits/OQRDHC0-sized.jpg')">
					<x-slot:caption>
						<a href="https://www.freepik.com" target='freepik'>Designed by Ajipebriana /
							Freepik</a>
					</x-slot:caption>
				</x-media.captionable-image>
			</section>
			<section class='w-full flex flex-col gap-2 text-center'>
				<h2 class='text-2xl'>Technology background design</h2>
				<p>This is used in the primary dark theme as the basis for the glowing circuitry pattern.</p>
				<p><a
						href='https://www.freepik.com/free-vector/technology-background-design_1140427.htm#fromView=search&page=1&position=11&uuid=c9933de5-2b29-4f44-9393-4352d9234c8b&query=circuit+traces+cc0'
						target='tech-vector-bg-1'>View Original</a></p>
			</section>
		</x-column>

		<x-column class='flex flex-col gap-6'>
			<section class='w-full flex flex-col gap-2 text-center'>
				<x-media.captionable-image :src="asset_url('credits/grunge-stone-texture-background-sized.jpg')">
					<x-slot:caption>
						<a href="https://www.freepik.com" target='freepik'>Designed by
							kjpargeter /
							Freepik</a>
					</x-slot:caption>
				</x-media.captionable-image>
			</section>
			<section class='w-full flex flex-col gap-2 text-center'>
				<h2 class='text-2xl'>Grunge stone texture background</h2>
				<p>This is used as part of the alternate dark theme. If you switch to Dark Mode and then the Industrial theme
					from the settings menu, you can see the background that makes use of this work.</p>
				<p><a
						href='https://www.freepik.com/free-photo/grunge-stone-texture-background_2795517.htm#fromView=search&page=1&position=29&uuid=e494893a-0bf0-49b4-b7de-a7949cb8c3de&query=metal+texture+dark+cc0'
						target='grunge-stone-bg-1'>View Original</a></p>
			</section>
		</x-column>
	</x-row>
</root>
