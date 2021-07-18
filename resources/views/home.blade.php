@extends('layouts.page')

@section('content')

	<x-row class="bg-laptop-dark -mt-4">

		<div class="flex md:order-2 md:w-1/2 lg:w-5/12 xl:w-1/3">
			<div class="px-2">

				<img src="https://s3.amazonaws.com/elliotderhay-com/Elliot.Color2-hd-v2-square.jpg" title="Elliot Derhay" alt="Photo of Elliot Derhay" class="border-white border-4 rounded-full box-glow">

			</div>
		</div>

		<div class="md:order-1 md:w-1/2 lg:w-7/12 xl:w-2/3">
			<div class="px-2">

				<h1 class="content-title text-4xl pt-6 mt-4 md:mt-0 md:pt-0 text-center md:text-left">
					About Me
				</h1>

				<p class="mb-4">
					I am a web developer experienced in building WordPress websites. I primarily use CSS and PHP on these projects, but I do occasionally need to write some JavaScript.
				</p>

				<p class="mb-4">
					My PHP experience is mostly a mix of vanilla PHP and WordPress's framework, though I also have some experience with Laravel—and I love every minute I get to work with it.
				</p>

				<p class="mb-4">
					My JavaScript experience is mostly vanilla JS and jQuery. Other experience includes a few months worth of MeteorJS with Blaze, and some Vue between a few other projects.
				</p>

				<p class="mb-4">
					Lastly, I love being a Linux user. I run Kubuntu on my personal laptop, and I run Ubuntu via WSL on my work laptop so I can access my favorite Linux tools.
				</p>

			</div>
		</div>

	</x-row>

	<x-row>

		<div class="block md:w-1/2">
			<h2 class="content-title text-2xl pt-6 mt-4 text-center">Latest Tweet</h2>
			<section id="twitter_timeline-home">
				<x-twitter-timeline count="1"/>
			</section>
		</div>

		<div class="block md:w-1/2">
			<h2 class="content-title text-2xl pt-6 mt-4 text-center">GitHub Activity</h2>
			<section id="github_events_feed-home">
				<x-github-events-feed count="3"/>
			</section>
		</div>

	</x-row>

@endsection
