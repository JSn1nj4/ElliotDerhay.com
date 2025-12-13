<div class="flex flex-row relative">
	<x-github.event-icon :icon='$icon' />

	<div class="pl-4 grow relative">
		<p class="text-neutral-800 dark:text-slate-500">
			{{ $timeElapsed }}
		</p>

		<p class="font-white mt-1 text-sm leading-none">
			<strong>
				<a href="{{ $profileUrl() }}" target="_blank">
					{{ $event->user->display_login }}
				</a>

				{{ $action }}

				{{-- If there's no ref, it's assumed a repo was created --}}
				@unless($refName === null)
					<a href="{{ $refUrl }}" target="_blank">
						{{ $refName }}
					</a>

				@endunless
				{{ $preposition }}

				<a href="{{ $repoUrl() }}" target="_blank">
					{{ $event->repo }}
				</a>
			</strong>
		</p>
	</div>
</div>
