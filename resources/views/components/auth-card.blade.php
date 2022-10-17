<div class="flex flex-col flex-grow sm:justify-center items-center pt-6 sm:pt-0 border-sea-green-">

		@isset($logo)
			<div>
					{{ $logo }}
			</div>
		@endisset

    <div class="w-full sm:max-w-sm mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md dark:shadow-gray-700 overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
