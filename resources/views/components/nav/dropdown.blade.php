<div class='relative z-10'>
	<div
		class="relative block">
		<div class='{{ $toggleClasses }}'>{!! $toggle !!}</div>
		<div
			class='{{ $wrapperClasses }}'>
			<div
				class='{{ $containerClasses }}'>
				<div class='{{ $triangleWrapperClasses }}'>
					<div class='relative h-full w-full'>
						<div
							class='absolute bottom-0 border-solid border-b-[1.5rem] border-b-bright-turquoise-900 dark:border-b-bright-turquoise-500 fun:border-b-slate-900 border-x-[1rem] border-x-transparent'></div>
						<div
							class='absolute bottom-0 left-[0.23rem] border-solid border-b-[1.2rem] border-b-big-stone-100 dark:border-b-big-stone-950 fun:border-b-big-stone-950 border-x-[0.85rem] border-x-transparent'></div>
						<div
							class='absolute bottom-0 left-[0.23rem] border-solid border-b-[1.2rem] border-b-transparent dark:border-b-black/60 fun:border-b-transparent border-x-[0.85rem] border-x-transparent'></div>
					</div>
				</div>
				{!! $slot !!}
			</div>
		</div>
	</div>
</div>
