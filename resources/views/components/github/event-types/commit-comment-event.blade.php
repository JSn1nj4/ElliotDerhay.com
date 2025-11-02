<div class="flex flex-row relative">
	<x-github.event-icon :icon='$icon' />

	<div class="pl-4 grow relative">
		<p class="text-neutral-800 dark:text-neutral-500">
			{{ $timeElapsed }}
		</p>

		<p class="font-white mt-1 text-sm leading-none">
			<strong>
				<a href="{{ $profileUrl() }}" target="_blank">
					{{ $event->user->display_login }}
				</a>

				{{ $action }}

				{{-- no refUrl assumes it was deleted --}}
				@if($refUrl === null)
					<span class="text-bright-turquoise-600 dark:text-bright-turquoise-800">
						{{ $refName }}
					</span>
				@else
					<a href="{{ $refUrl }}" target="_blank">
						{{ $refName }}
					</a>
				@endif


				{{ $preposition }}

				<a href="{{ $repoUrl() }}" target="_blank">
					{{ $event->repo }}
				</a>
			</strong>
		</p>
	</div>
</div>
