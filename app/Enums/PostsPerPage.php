<?php

namespace App\Enums;

use App\Enums\Traits\PerPageHelpers;

enum PostsPerPage: int {
	use PerPageHelpers;

	case MIN = 1;
	case MAX = 100;
	case DEFAULT = 10;
}
