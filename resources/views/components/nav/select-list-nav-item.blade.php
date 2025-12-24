@props([
	'label'
])
<div
	class='w-full relative justify-items-start place-items-center gap-2 text-left text-bright-turquoise-800 dark:text-bright-turquoise-500 hover:text-neutral-700 dark:hover:text-white transition-colors duration-300 uppercase'
	x-data='selectList("{{ $eventKey }}", "{{ $dispatch }}", "{{ $listen }}")'
>
	@isset($label)
		<label class='text-sm' for='{{ $id }}'>{{ $label }}</label>
	@endisset
	<select
		class='w-full rounded border border-slate-500 dark:border-slate-700 dark2:border-slate-600 bg-slate-200 dark:bg-neutral-950 dark2:bg-slate-700 px-4 py-1 appearance-none transition-colors'
		name='{{ $name }}'
		id='{{ $id }}'
		x-model='value'
		x-on:change='send'
		x-ref='list'
	>
		{{ $slot }}
	</select>
	<x-fas-caret-down class="absolute top-3 right-4 h-full size-3 pointer-events-none" />
</div>
@vite('resources/js/blade-components/nav/select-list-nav-item.ts')
