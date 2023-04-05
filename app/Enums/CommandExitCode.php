<?php

namespace App\Enums;

enum CommandExitCode: int {
	case SUCCESS = 0;
	case FAILURE = 1;
	case INVALID = 2;
}
