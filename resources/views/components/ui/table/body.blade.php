<tbody {{ $attributes->class([
	'table-row-group',
	$class
])->merge([
	'id' => strlen($id) > 0 ? $id : null,
]) }}>{{ $slot }}</tbody>
