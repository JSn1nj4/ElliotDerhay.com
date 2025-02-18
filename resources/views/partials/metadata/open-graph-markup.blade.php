<meta property="og:title" content="{{ $title }}" />
<meta property="og:description" content="{{ $description }}" />
<meta property="og:url" content="{{ $url }}" />
<meta property="og:type" content="{{ $type }}" />
@isset($publishedTime)
	<meta property="article:published_time" content="{{ $ublishedTime }}" />
@endisset
@isset($modifiedTime)
	<meta property="article:modified_time" content="{{ $modifiedTime }}" />
@endisset
@isset($image)
	<meta property="og:image" content="{{ $image }}" />
@endisset
