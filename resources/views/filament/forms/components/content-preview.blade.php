<x-dynamic-component
	:component="$getFieldWrapperView()"
	:field="$field"
	class='h-full grid-rows-[auto_1fr]'
>
	@php $preparePreview($get($field->getSourceField())) @endphp
	<div
		x-data="{ state: $wire.$entangle(@js($getStatePath())) }"
		class='h-full'
		{{ $getExtraAttributeBag() }}
	>
		<iframe src="{{ $getRoute() }}" class='w-full min-h-128 h-full'></iframe>
	</div>
	@php $purgeStalePreview() @endphp
</x-dynamic-component>
