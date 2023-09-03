<meta property="og:type" content="{{ $type }}" />
<meta property="og:title" content="{{ $title }}" />
<meta property="og:description" content="{{ $description }}" />
<meta property="og:url" content="{{ $url }}" />
@isset($image)
<meta property="og:image" content="{{ $image }}" />
@endisset
