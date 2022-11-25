<?php

namespace App\View\Components\Ui\Enums;

enum TextInputType: string
{
	case Email = 'email';
	case Password = 'password';
	case Tel = 'tel';
	case Text = 'text';
}
