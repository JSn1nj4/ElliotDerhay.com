@extends('layouts.page')

@section('page-title', 'Elliot\'s Projects - ElliotDerhay.com')
@section('meta-description', 'Below are projects that I\'ve either built myself or contributed directly to. Some will also have links to demos.')

@section('content')
	<div class="container mx-auto px-4 pt-6">
		<section class="block">

			<div class="w-full pb-6 text-center">
				<div class="px-2">
					<h1 class="content-title text-4xl pt-6 mt-4 md:pt-0 md:mt-0">
						Projects
					</h1>
					<p class="mb-4">
						Below are projects that I've either built myself or contributed directly to. Some will also have links to demos.
					</p>
				</div>
			</div>

		</section>

		<section class="block w-full md:flex">

			<div class="w-full pb-8 px-2 pt-6 mt-4 md:pt-0 md:mt-0">
				<section id="main-projects-list-wrapper">
					@include('partials.projects-list', ['projects' => $projects])
				</section>
			</div>

		</section>
	</div>
@endsection
