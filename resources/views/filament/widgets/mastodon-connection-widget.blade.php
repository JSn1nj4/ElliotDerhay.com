<x-filament-widgets::widget>
	<x-filament::section>
		<h2 class='text-xl'>Mastodon</h2>
		<div class='grid md:grid-cols-2 gap-2'>
			<div>Server</div>
			<div>{{ $server }}</div>
			<div>Connection</div>
			<div>{{ $health->label() }}</div>
		</div>
	</x-filament::section>
</x-filament-widgets::widget>
