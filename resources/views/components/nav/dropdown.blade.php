<div class='relative z-10'>
	<div
		class="relative block mr-3 border-l-2 border-solid border-bright-turquoise-600 dark:border-bright-turquoise-800 pl-3">
		{!! $toggle !!}
		<div
			class='absolute -left-32 top-10 -z-50 opacity-0 border-2 border-solid border-bright-turquoise-900 dark:border-bright-turquoise-500 fun:border-slate-900 rounded-xl w-48 bg-big-stone-100 dark:bg-big-stone-950  toggle-submenu peer-checked:opacity-100 peer-checked:z-50 transition-opacity'>
			<div class='relative flex flex-col gap-3 rounded-xl dark:bg-black/60 fun:bg-transparent w-full h-full p-3'>
				<div class='absolute -top-7 right-4 h-7 w-10'>
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
