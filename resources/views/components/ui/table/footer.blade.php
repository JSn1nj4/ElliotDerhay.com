<tfoot {{ $attributes->class([
	'table-footer-group',
	$class,
])->merge([
	'id' => strlen($id) > 0 ? $id : null,
]) }}>{{ $slot }}</tfoot>
