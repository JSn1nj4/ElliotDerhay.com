<div class="flex flex-col flex-grow sm:justify-center items-center pt-6 sm:pt-0 border-seaGreen-">

		@isset($logo)
			<div>
					{{ $logo }}
			</div>
		@endisset

    <div class="w-full sm:max-w-sm mt-6 first:mt-0 px-6 py-4 bg-white dark:bg-neutral-800 shadow-md dark:shadow-neutral-700 overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
