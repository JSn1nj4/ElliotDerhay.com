@extends('layouts.blog')

@section('blog')
	<form method="post" action="{{ action([\App\Http\Controllers\PostsController::class, 'store']) }}">
		@csrf
		<div class="flex flex-col mb-6 gap-2">
			<label for="title" class="text-3xl">Post Title</label>
			<input id="title" name="title" type="text" class="text-2xl p-3 dark:bg-gray-800 outline outline-1 outline-gray-700 focus:outline-gray-600 transition-colors dark:transition-colors duration-300 rounded">
		</div>

		<div class="flex flex-col my-6 gap-2">
			<label for="slug" class="text-2xl">Slug</label>
			<input type="text" id="slug" name="slug" class="text-lg p-2 dark:bg-gray-800 outline outline-1 outline-gray-700 focus:outline-gray-600 transition-colors dark:transition-colors duration-300 rounded">
		</div>

		<div class="flex flex-col my-6 gap-2">
			<label for="body" class="text-2xl">Body</label>
			<textarea name="body" id="body" class="w-full text-lg p-2 dark:bg-gray-800 outline outline-1 outline-gray-700 focus:outline-gray-600 transition-colors dark:transition-colors duration-300 rounded h-64"></textarea>
		</div>

		<div class="flex flex-row mt-6 place-content-end">
			<button type="submit" class="bg-sea-green-600 hover:bg-gray-700/50 transition-colors dark:transition-colors duration-300 rounded px-3 py-1 text-2xl dark:text-black dark:hover:text-white">Publish</button>
		</div>
	</form>
@endsection
