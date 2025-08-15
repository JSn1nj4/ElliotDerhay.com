<x-filament-panels::page>
	<form wire:submit="create">
		{{ $this->form }}

		<x-filament::button type="submit" icon="o-arrow-up-tray" icon-position="after" class="mt-6 w-full">
			Upload
		</x-filament::button>
	</form>
</x-filament-panels::page>
