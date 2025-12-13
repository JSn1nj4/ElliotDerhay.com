<div class='relative z-10'>
	<div
		class="relative block">
		<div class='{{ $toggleClasses }}'>{!! $toggle !!}</div>
		<div
			class='{{ $wrapperClasses }}'>
			<div
				class='{{ $containerClasses }}'>
				{!! $slot !!}
			</div>
		</div>
	</div>
</div>
