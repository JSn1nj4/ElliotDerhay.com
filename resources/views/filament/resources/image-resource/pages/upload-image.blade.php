<x-filament-panels::page>
	<x-filament-panels::form wire:submit="create">
		{{ $this->form }}

		<x-filament::button type="submit">
			Upload
		</x-filament::button>
	</x-filament-panels::form>
</x-filament-panels::page>
