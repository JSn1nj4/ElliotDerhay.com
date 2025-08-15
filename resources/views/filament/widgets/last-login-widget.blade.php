<x-filament-widgets::widget>
	<x-filament::section>
		<div class='flex items-center'>
			<h2 class='grow text-2xl'>Last Login</h2>
			<table>
				<tbody>
				<tr>
					<th class='text-left pr-4'>Time:</th>
					<td class='text-right'>{{ $time->toDayDateTimeString() }}</td>
				</tr>
				<tr>
					<th class='text-left pr-4'>IP Address:</th>
					<td class='text-right'>{{ $ip_address }}</td>
				</tr>
				</tbody>
			</table>
		</div>
	</x-filament::section>
</x-filament-widgets::widget>
