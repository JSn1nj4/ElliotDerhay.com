<?php

namespace App\Models;

use App\Contracts\ImageableContract;
use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Model;

abstract class ImageableModel extends Model implements ImageableContract
{
	use Imageable;
}
