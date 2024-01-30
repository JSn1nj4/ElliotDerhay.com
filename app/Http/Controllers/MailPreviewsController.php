<?php

namespace App\Http\Controllers;

use App\Mail\WeeklyReportEmail;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\View\View;

class MailPreviewsController extends Controller
{
	private array $mailables = [
		'weekly-report' => WeeklyReportEmail::class,
	];

	public function show(string $name): View|Mailable {
		if (!isset($this->mailables[$name])) {
			throw new \InvalidArgumentException("No Mailable registered for name '{$name}'.");
		}

		$class = $this->mailables[$name];

		if (!class_exists($class)) {
			throw new \Exception("Class '{$class}' does not exist.");
		}

		return new $class;
	}
}
