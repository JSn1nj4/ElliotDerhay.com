<?php

namespace App\DataTransferObjects;


readonly class QueryParam
{
	public const EMPTY_PLACEHOLDER = ':allow_empty:';
	public mixed $value;

	public function __construct(
		public string $field,
		mixed         $value = null,
		/** @var bool $boolean Query string processors should use this to decide whether a query param should be included empty */
		public bool   $allow_empty = false)
	{
		$this->value = match (true) {
			$allow_empty && $value === null => self::EMPTY_PLACEHOLDER,
			default => $value,
		};
	}
}
