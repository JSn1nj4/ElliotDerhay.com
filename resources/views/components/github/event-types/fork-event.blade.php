<div class="flex flex-row relative">
	<x-github.event-icon :icon='$icon' />

	<div class="pl-4 flex-grow relative">
		<p class="text-neutral-800 dark:text-neutral-500">
			{{ $timeElapsed }}
		</p>

		<p class="font-white mt-1 text-sm leading-none">
			<strong>
				<a href="{{ $profileUrl() }}" target="_blank">
					{{ $event->user->display_login }}
				</a>

				{{ $action }}

				<a href="https://github.com/{{ $event->source }}" target="_blank">
					{{ $event->source }}
				</a>

				{{ $preposition }}

				<a href="{{ $repoUrl() }}" target="_blank" class="text-caribbeanGreen-600 dark:text-caribbeanGreen-500">
					{{ $event->repo }}
				</a>
			</strong>
		</p>

	</div>
</div>
