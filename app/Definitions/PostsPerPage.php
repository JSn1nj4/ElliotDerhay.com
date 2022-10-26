<?php

namespace App\Definitions;

use App\Definitions\Traits\PerPageHelpers;

enum PostsPerPage: int {
	use PerPageHelpers;

	case MIN = 1;
	case MAX = 100;
	case DEFAULT = 10;
}
