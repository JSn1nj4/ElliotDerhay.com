<?php

namespace App\Contracts;

use App\DataTransferObjects\XMetaDTO;

interface XMetaContract
{
	public function xCardMeta(): XMetaDTO;
}
