<div class='relative z-10'>
	<div class="block mr-3 border-l-2 border-solid border-bright-turquoise-600 dark:border-bright-turquoise-800 pl-3">
		{!! $toggle !!}
		<div class='absolute left-0 -z-50 invisible toggle-submenu peer-checked:visible peer-checked:z-50'>
			{!! $slot !!}
		</div>
	</div>
</div>
