<div class="twitter-card">
	<x-card size="sm">

		<div class="flex flex-row relative">
			<div>
				<a href="{{ $tweet->user->profile_url }}" target="_blank">
					<img width="48" height="48" src="{{ $tweet->user->profile_image_url_https }}" class="border-solid border-2 border-black dark:border-white rounded-full">
				</a>
			</div>

			<div class="pl-4 flex-grow relative">
				<p>
					<a href="{{ $tweet->user->profile_url }}" target="_blank" class="font-bold">
						{{ $tweet->user->name }}
					</a><br>
					<a href="{{ $tweet->user->profile_url }}" target="_blank" class="text-gray-800 dark:text-gray-600">
						{{ "@" . $tweet->user->screen_name }}
					</a>
				</p>
			</div>

			<div class="pl-4 flex-none relative">
				<a href="https://twitter.com" target="_blank">
					<i class="fab fa-twitter text-4xl text-black dark:text-white"></i>
				</a>
			</div>
		</div>

		<div class="pt-4 flex flex-row relative font-bold">
			<p>{!! html_entity_decode($tweet->formatted_body) !!}</p>
		</div>

		<div class="pt-4 flex flex-row relative">
			<div class="flex-grow">
				<p>
					<a href="{{ $tweet->url }}" target="_blank" class="font-bold">View on Twitter</a>
				</p>
			</div>

			<div class="pl-4 flex-none relative">
				<p>
					<a href="{{ $tweet->url }}" target="_blank" class="font-bold">
						{{ $tweet->date->format('d M Y') }}
					</a>
				</p>
			</div>
		</div>

	</x-card>
</div>
