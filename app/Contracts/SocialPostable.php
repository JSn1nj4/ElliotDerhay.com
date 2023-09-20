<?php

namespace App\Contracts;

use App\DataTransferObjects\SocialPostDTO;

interface SocialPostable
{
	/**
	 * Get standardized post data for posting
	 * @return \App\DataTransferObjects\SocialPostDTO
	 */
	public function getPostable(): SocialPostDTO;
}
