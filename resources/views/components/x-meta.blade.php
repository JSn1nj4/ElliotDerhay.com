@php /** @var \App\DataTransferObjects\XMetaDTO $metadata */ @endphp
<meta name="twitter:card" content="{{ $metadata->xCard->value }}">
<meta name="twitter:site" content="{{ $metadata->xSite }}">
@if($metadata->xCard === \App\Enums\XMetaCardType::SummaryLargeImage)
	<meta name="twitter:creator" content="{{ $metadata->xCreator }}">
@endif
<meta name="twitter:title" content="{{ $metadata->xTitle }}">
<meta name="twitter:description" content="{{ $metadata->xDescription }}">
<meta name="twitter:image" content="{{ $metadata->xImage }}">
