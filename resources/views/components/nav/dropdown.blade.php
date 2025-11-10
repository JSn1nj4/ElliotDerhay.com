<div class='relative z-10'>
	<div
		class="relative block mr-3 border-l-2 border-solid border-bright-turquoise-600 dark:border-bright-turquoise-800 pl-3">
		{!! $toggle !!}
		<div
			class='absolute left-0 -z-50 opacity-0 toggle-submenu peer-checked:opacity-100 peer-checked:z-50 transition-opacity'>
			{!! $slot !!}
		</div>
	</div>
</div>
