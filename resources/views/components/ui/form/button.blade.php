<button type="{{ $buttonType->value }}" class="{{ $classes() }}" {{
    $attributes->merge(['form' => $form])
 }}>{{ $slot }}</button>
