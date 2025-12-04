@props([
	'label'
])
<div
	class='justify-items-start place-items-center gap-2 text-left text-bright-turquoise-800 dark:text-bright-turquoise-500 hover:text-neutral-700 dark:hover:text-white transition-colors duration-300'>
	@isset($label)
		<label class='' for='{{ $id }}'>{{ $label }}</label>
	@endisset
	<select class='' name='{{ $name }}' id='{{ $id }}'>
		{{ $slot }}
	</select>
</div>
