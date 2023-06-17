<textarea
	id="{{ $id }}"
	name="{{ $name }}"
	{{ $attributes->merge(compact('form'))->class([
    'w-full',
    $textSize,
    $padding,
    'dark:bg-gray-800',
    'outline',
    'outline-1',
    'outline-gray-700',
    'focus:outline-gray-600',
    'transition-colors',
    'dark:transition-colors',
    'duration-300',
    'rounded',
    $height->value,
    'outline-red-200 focus:outline-red-100 dark:bg-red-900' => $error
]) }}>{{ $slot }}</textarea>
