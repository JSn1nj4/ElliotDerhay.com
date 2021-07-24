<div class="flex flex-row relative">
	<div class="text-gray-500 text-center flex-none {{ $icon }}" style="width: 2rem; font-size: 22px;"></div>

	<div class="pl-4 flex-grow relative">
		<p class="text-gray-500">
			{{ $timeElapsed }}
		</p>

		<p class="font-white mt-1 text-sm leading-none">
			<strong>
				<a href="{{ $profileUrl() }}" target="_blank">
					{{ $event->user->display_login }}
				</a>

				{{ $action }}

				<span class="text-sea-green-800">
					{{ $refName }}
				</span>

				{{ $preposition }}

				<a href="{{ $repoUrl() }}" target="_blank">
					{{ $event->repo }}
				</a>

			</strong>
		</p>

	</div>
</div>
