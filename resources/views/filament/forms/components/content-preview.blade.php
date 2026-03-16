<x-dynamic-component
	:component="$getFieldWrapperView()"
	:field="$field"
>
	<div
		x-data="{ state: $wire.$entangle(@js($getStatePath())) }"
		{{ $getExtraAttributeBag() }}
	>
		<x-markdown>{!! $getContent() !!}</x-markdown>
	</div>
</x-dynamic-component>
