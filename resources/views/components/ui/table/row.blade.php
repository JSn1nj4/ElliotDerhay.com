<tr {{ $attributes->class([
	'table-row',
	'text-left',
	$class,
])->merge([
	'id' => strlen($id) > 0 ? $id : null,
]) }}>{{ $slot }}</tr>
