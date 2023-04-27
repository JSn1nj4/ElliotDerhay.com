@php use App\Features\GithubFeed;use App\Features\TwitterFeed;use Laravel\Pennant\Feature; @endphp
@extends('layouts.page')

@section('content')

	<x-row id="about" overlay-classes="bg-sea-green-100 bg-opacity-50 dark:bg-sea-green-800 dark:bg-opacity-75"
				 background-image="{{ asset_url('pexels-lukas-574073-scaled.jpg') }}">
		<x-column class="flex md:order-2 md:w-1/2 lg:w-5/12 xl:w-1/3">
			<img src="{{ asset_url("Elliot.Color2-hd-v2-square.jpg") }}" title="Elliot Derhay" alt="Photo of Elliot Derhay"
					 class="border-black dark:border-white border-2 border-opacity-40 rounded-full">
		</x-column>

		<x-column class="md:order-1 md:w-1/2 lg:w-7/12 xl:w-2/3">
			<h1 class="content-title text-4xl pt-6 mt-4 md:mt-0 md:pt-0 text-center md:text-left">
				Who I Am
			</h1>

			<p class="mb-4 text-xl">
				I'm a fairly simple guy who loves web development and design. I love learning new software and web development
				concepts. I like learning in general, but especially about science and technology.
			</p>

			<p class="mb-4 text-xl">
				When I'm not spending time learning something new, you can probably find me reading tech news and current
				events, watching videos by channels like Veritasium and SmarterEveryDay, reading comics like Dilbert and xkcd,
				playing card games, or playing puzzle games like Sudoku.
			</p>
		</x-column>
	</x-row>

	<x-row :flex-class="null" id="projects">
		<x-column>
			<h2 class="content-title text-4xl pt-6 mt-5 md:mt-0 md:pt-0">
				What I Do
			</h2>

			<p class="mb-4 text-xl">
				I primarily work on WordPress projects, but I love working with Laravel. My primary side project is this
				website. I use it as both a personal profile and a sandbox for learning new
				concepts. {{-- Below are some projects I maintain or contribute to, as well as some I have worked on in the past. --}}
			</p>

			<x-project.grid :count="3"/>
		</x-column>
	</x-row>

	<x-row :flex-class="null" class="bg-sea-green-200 dark:bg-sea-green-500 bg-opacity-40 dark:bg-opacity-25"
				 id="connect">
		<x-column class="block w-full">
			<h2 class="content-title text-4xl pt-6 mt-5 md:mt-0 md:pt-0">
				What I'm Up To
			</h2>

			<p class="mb-4 text-xl">
				I can usually be found on Twitter and GitHub. I've also been known to occasionally write and comment on <a
					href="https://dev.to/jsn1nj4" target="_blank">dev.to</a> articles.
			</p>
		</x-column>

		<div class="block md:flex">
			<x-column class="block md:w-1/2">
				<h2 class="content-title text-2xl pt-6 mt-4 text-center">Latest Blog Post</h2>
				<section id="blog_feed-home">
					<x-post.latest />
				</section>
			</x-column>

			@feature(GithubFeed::class)
				<x-column class="block md:w-1/2">
					<h2 class="content-title text-2xl pt-6 mt-4 text-center">GitHub Activity</h2>
					<section id="github_events_feed-home" class="font-mono">
						<x-github.events-feed count="3"/>
					</section>
				</x-column>
			@endfeature
		</div>

	</x-row>

@endsection
