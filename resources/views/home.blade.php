@extends('layouts.page')

@section('content')

	<x-row class="bg-laptop-dark -mt-4">
		<x-column class="flex md:order-2 md:w-1/2 lg:w-5/12 xl:w-1/3">
			<img src="https://s3.amazonaws.com/elliotderhay-com/Elliot.Color2-hd-v2-square.jpg" title="Elliot Derhay" alt="Photo of Elliot Derhay" class="border-white border-4 rounded-full box-glow">
		</x-column>

		<x-column class="md:order-1 md:w-1/2 lg:w-7/12 xl:w-2/3">
			<h1 class="content-title text-4xl pt-6 mt-4 md:mt-0 md:pt-0 text-center md:text-left">
				Who I Am
			</h1>

			<p class="mb-4 text-xl">
				I'm a fairly simple guy who loves web development and design. I love learning new software and web development concepts; but I also love learning about science and other technologies, and even learning more generally.
			</p>

			<p class="mb-4 text-xl">
				When I'm not spending time learning something new, you can probably find me reading tech news and current events, watching videos by channels like Veritasium and SmarterEveryDay, reading comics like Dilbert and xkcd, playing card games, or playing sudoku.
			</p>
		</x-column>
	</x-row>

	<x-row :flex="false">
		<x-column>
			<h2 class="content-title text-4xl pt-6 mt-5 md:mt-0 md:pt-0">
				What I Do
			</h2>

			<p class="mb-4 text-xl">
				I primarily work on WordPress projects, but I love working with Laravel. My primary side project is this website. I use it as both a personal profile and a sandbox for learning new concepts. @unless ($projects->isEmpty()) Below are some projects I maintain or contribute to, as well as some I have worked on in the past. @endunless
			</p>
		</x-column>

		@unless ($projects->isEmpty())
			<div class="block md:flex flex-wrap projects-list pb-4">
				@each('partials.project-card', $projects, 'project')
			</div>
		@endunless
	</x-row>

	<x-row :flex="false">
		<x-column class="block w-full">
			<h2 class="content-title text-4xl pt-6 mt-5 md:mt-0 md:pt-0">
				What I'm Up To
			</h2>

			<p class="mb-4 text-xl">
				I can usually be found on Twitter and GitHub. I've also been known to occasionally write and comment on <a href="https://dev.to/jsn1nj4" target="_blank">dev.to</a> articles.
			</p>
		</x-column>

		<div class="block md:flex">
			<x-column class="block md:w-1/2">
				<h2 class="content-title text-2xl pt-6 mt-4 text-center">Latest Tweet</h2>
				<section id="twitter_timeline-home">
					<x-twitter-timeline count="1"/>
				</section>
			</x-column>

			<x-column class="block md:w-1/2">
				<h2 class="content-title text-2xl pt-6 mt-4 text-center">GitHub Activity</h2>
				<section id="github_events_feed-home" class="font-mono">
					<x-github-events-feed count="3"/>
				</section>
			</x-column>
		</div>
	</x-row>

@endsection
