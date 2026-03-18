<x-dynamic-component
	:component="$getFieldWrapperView()"
	:field="$field"
>
	<div
		x-data="{ state: $wire.$entangle(@js($getStatePath())) }"
		{{ $getExtraAttributeBag() }}
	>
		<iframe src='{{ route('content_preview', ['preview_ref' => $getPreviewRef()]) }}' class='w-full h-128]'></iframe>
	</div>
</x-dynamic-component>
