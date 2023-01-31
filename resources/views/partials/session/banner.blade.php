@if(session()->has('error') || session()->has('success'))
	<div class="container relative mx-auto px-4 pt-4 z-10">
		@include('partials.session.message')
	</div>
@endif
