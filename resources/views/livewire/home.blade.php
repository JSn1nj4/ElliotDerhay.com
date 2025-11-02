<?php

use Livewire\Volt\Component;

new class extends Component {
	//
}; ?>

<root>
	<x-row id="about" flex-class="flex flex-row flex-wrap">
		<x-column class="flex md:w-1/2 lg:w-5/12 xl:w-1/3">
			<img src="{{ asset_url("Elliot-head-on-square-color-medium.jpg") }}" title="Elliot Derhay"
					 alt="Photo of Elliot Derhay"
					 class="border-black dark:border-white border-2 border-opacity-40 rounded-3xl">
		</x-column>

		<x-column class="md:order-first md:w-1/2 lg:w-7/12 xl:w-2/3">
			<div class='flex flex-col gap-4'>
				<h1
					class="text-2xl pt-6 mt-4 md:mt-0 md:pt-0 uppercase">
					About me
				</h1>

				<p class='text-3xl'>
					Hey, there! I'm Elliot Derhay.
				</p>

				<p class="text-xl">
					I'm a web developer. I work primarily with WordPress and squeeze in a Laravel project whenever I can. I also
					dream up more ideas than I have time to actually work on.
				</p>

				<p class="text-xl">
					I also love blogging — the part where I hammer out words before remembering that tech blogging needs
					supporting
					examples.
				</p>

				<p class="text-xl">
					You can find also find me on Twitter/X sometimes Tweeting/Xeeting/posting into the Ether, and reading about
					what's going on in tech and the broader world. I also used to blog on dev.to occasionally.
				</p>

				<p class="text-xl">
					I'm also a Bible-believing Christian, husband, and father. And I love playing board and card games when time
					allows.
				</p>
			</div>
		</x-column>

		@feature(App\Features\BlogIndex::class)
		<x-column class="block md:w-1/2">
			<h2 class="content-title text-2xl pt-6 mt-4 uppercase">
				Latest Blog Post</h2>
			<section id="blog_feed-home">
				<x-post.latest />
			</section>
		</x-column>
		@endfeature

		@feature(App\Features\GithubFeed::class)
		<x-column class="block md:w-1/2">
			<h2 class="content-title text-2xl pt-6 mt-4 uppercase">
				GitHub Activity</h2>
			<section id="github_events_feed-home" class="font-mono">
				<x-github.events-feed padding="px-4 py-6" count="5" />
			</section>
		</x-column>
		@endfeature
	</x-row>
</root>
