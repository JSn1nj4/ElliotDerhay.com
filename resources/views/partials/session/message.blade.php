@if(session()->has('error'))
	<div class="block p-3 bg-red-200 dark:bg-red-900 border border-red-800 dark:border-red-100 text-red-800 dark:text-red-100 rounded flex-grow">
		{{ session('error') }}
	</div>
@elseif(session()->has('success'))
	<div class="block p-3 bg-green-200 dark:bg-green-900 border border-green-900 dark:border-green-200 text-green-900 dark:text-green-200 rounded flex-grow">
		{{ session('success') }}
	</div>
@endif
