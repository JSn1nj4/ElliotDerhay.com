<?php

use Livewire\Volt\Component;

new class extends Component {
	//
}; ?>

<root>
	<x-row id="about" class="my-12" flex-class="flex flex-col md:flex-row gap-12">
		<x-column class="md:w-1/2 lg:w-5/12 xl:w-1/3">
			<x-media.lightboxable
				:src='asset_url("Elliot-head-on-square-color-medium.jpg")' title='Elliot Derhay'
				alt="Photo of Elliot Derhay"
			>
				<x-slot:caption>
					<a href='https://www.derhaydesign.com/' target='derhay-design'>Photo by Katie Derhay /
						DerhayDesign.com</a>
				</x-slot:caption>
			</x-media.lightboxable>
		</x-column>

		<x-column
			class="md:order-first md:w-1/2 lg:w-7/12 xl:w-2/3">
			<div
				class='flex flex-col gap-4 md:bg-none dark:rounded-3xl dark:border dark:border-slate-600 dark:hover:border-bright-turquoise-500 dark:md:border-none dark:bg-neutral-950 dark:md:bg-transparent dark:p-4 dark:md:p-0'>
				<h1
					class="text-2xl uppercase">
					About me
				</h1>

				<p class='text-3xl'>
					Hey, there! I'm Elliot Derhay.
				</p>

				<p class="text-xl">
					I'm a web developer. I work primarily with WordPress and squeeze in a Laravel project whenever I can. I also
					tend to
					dream up more ideas than I have time to actually work on.
				</p>

				<p class="text-xl">
					I love blogging — and by blogging, I mean hammering out words and eventually remembering that tech blogs
					needs lots of supporting examples. One day I want to answer the eternal question: is my small amount of
					spare time better spent blogging or building...?
				</p>

				<p class="text-xl">
					Lastly, I'm a Bible-believing Christian, husband, and father who sometimes plays card and board games.
				</p>
			</div>
		</x-column>
	</x-row>

	<x-row class="my-12" flex-class="flex flex-col md:flex-row gap-12">
		@feature(App\Features\BlogIndex::class)
		<x-column class="block md:w-1/2">
			<h2 class="content-title text-2xl uppercase">
				Latest Blog Post</h2>
			<section id="blog_feed-home">
				<x-post.latest />
			</section>
		</x-column>
		@endfeature

		@feature(App\Features\GithubFeed::class)
		<x-column class="block md:w-1/2">
			<h2 class="content-title text-2xl uppercase">
				GitHub Activity</h2>
			<section id="github_events_feed-home" class="font-mono">
				<x-github.events-feed padding="px-4 py-6" count="5" />
			</section>
		</x-column>
		@endfeature
	</x-row>
</root>
