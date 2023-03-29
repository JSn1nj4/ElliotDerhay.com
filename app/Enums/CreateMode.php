<?php

namespace App\Enums;

/**
 * The mode used for creating new models
 *
 * This is to aid in dynamically selecting methods for finding,
 * inserting, or updating models.
 */
enum CreateMode: string {
	case FirstOrCreate = 'firstOrCreate';
	case UpdateOrCreate = 'updateOrCreate';
}
