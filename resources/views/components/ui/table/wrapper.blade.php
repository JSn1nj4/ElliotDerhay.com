<table {{ $attributes->class([
	'w-full',
	'border-collapse',
	'table-auto',
	'bg-neutral-200',
	'dark:bg-neutral-800',
	'rounded-lg',
	$class,
])->merge([
	'id' => strlen($id) > 0 ? $id : null,
]) }}>{{ $slot }}</table>
