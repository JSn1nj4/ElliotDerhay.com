<table {{ $attributes->class([
	'w-full',
	'border-collapse',
	'table-auto',
	'bg-gray-800',
	'rounded-lg',
	$class,
])->merge([
	'id' => strlen($id) > 0 ? $id : null,
]) }}>{{ $slot }}</table>
