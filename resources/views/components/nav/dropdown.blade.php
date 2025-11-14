<div class='relative z-10'>
	<div
		class="relative block">
		<div class='peer md:hidden'>{!! $toggle !!}</div>
		<div
			class='absolute md:relative -right-7 md:right-0 top-20 md:top-0 -z-50 md:z-0 opacity-0 md:opacity-100 border-2 md:border-none border-solid border-bright-turquoise-900 dark:border-bright-turquoise-500 fun:border-slate-900 rounded-xl md:rounded-none w-48 w-auto bg-big-stone-100 dark:bg-big-stone-950 md:bg-none toggle-submenu peer-has-checked:opacity-100 peer-has-checked:z-50 transition-opacity'>
			<div
				class='relative flex flex-col md:flex-row gap-3 rounded-xl md:rounded-none dark:bg-black/50 w-full h-full p-3 md:p-0'>
				<div class='absolute -top-7 right-4 h-7 w-10 md:hidden md:-z-50'>
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
