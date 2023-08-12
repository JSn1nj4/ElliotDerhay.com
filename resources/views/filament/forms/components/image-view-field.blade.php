<x-dynamic-component
    :component="$getFieldWrapperView()"
		:field="$field"
>
		<img x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }" src="{{ $getRecord()->url }}" >
</x-dynamic-component>
