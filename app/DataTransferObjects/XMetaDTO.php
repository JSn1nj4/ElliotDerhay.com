<?php

namespace App\DataTransferObjects;

use App\Enums\XMetaCardType;

/**
 * TODO: if implementing other card types, either build in validator or create a factory.
 */
class XMetaDTO
{
	public function __construct(
		public string $xTitle,
		public string $xDescription,
		public XMetaCardType|null $xCard = null,
		public string|null $xSite = null,
		public string|null $xCreator = null,
		public string|null $xImage = null,
		public string|null $xImageAlt = null,
	) {
		$this->xCard ??= XMetaCardType::from(config('markup.x.card_type'));
		$this->xSite ??= config('markup.x.username');
		$this->xCreator ??= config('markup.x.username');
		$this->xImage ??= config('markup.x.image');
	}
}
