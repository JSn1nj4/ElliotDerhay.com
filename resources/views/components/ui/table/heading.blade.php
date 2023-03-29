<th {{ $attributes->class([
	'table-cell',
	'text-2xl',
	'uppercase',
	'p-6',
	$class,
])->merge([
	'id' => strlen($id) > 0 ? $id : null,
]) }}>{{ $slot }}</th>
