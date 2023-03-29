@if(session()->has('error'))
	<div class="block p-3 bg-red-900 border border-red-100 text-red-100 rounded flex-grow">
		{{ session('error') }}
	</div>
@elseif(session()->has('success'))
	<div class="block p-3 bg-green-900 border border-green-200 text-green-200 rounded flex-grow">
		{{ session('success') }}
	</div>
@endif
