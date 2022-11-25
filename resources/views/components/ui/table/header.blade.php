<thead {{ $attributes->class([
	'table-header-group',
	$class,
])->merge([
	'id' => strlen($id) > 0 ? $id : null,
]) }}>{{ $slot }}</thead>
