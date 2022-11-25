<td {{ $attributes->class([
	'table-cell',
	'p-6',
	'text-xl',
	$class
])->merge([
	'id' => strlen($id) > 0 ? $id : null,
]) }}>{{ $slot }}</td>
