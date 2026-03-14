<x-dynamic-component
	:component="$getFieldWrapperView()"
	:field="$field"
>
	@php $preparePreview($get($field->getSourceField())) @endphp
	<div
		x-data="{ state: $wire.$entangle(@js($getStatePath())) }"
		{{ $getExtraAttributeBag() }}
	>
		<iframe src="{{ $getRoute() }}" class='w-full h-128'></iframe>
	</div>
	@php $purgeStalePreview() @endphp
</x-dynamic-component>
