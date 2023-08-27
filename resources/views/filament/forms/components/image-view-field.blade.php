<x-dynamic-component
    :component="$getFieldWrapperView()"
		:field="$field"
>
	@if($getRecord() instanceof \App\Contracts\ImageableContract)
		<img x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }" src="{{ $getRecord()->image?->url }}" >
	@elseif($getRecord() instanceof \App\Models\Image)
		<img x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }" src="{{ $getRecord()->url }}" >
	@endif
</x-dynamic-component>
