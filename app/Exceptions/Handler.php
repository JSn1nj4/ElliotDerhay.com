<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

	/**
	 * Register the exception handling callbacks for the application.
	 */
	public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
	}

	/**
	 * Report or log an exception.
	 *
	 * @param  \Throwable  $e
	 * @return void
	 */
	public function report(Throwable $exception)
	{
		if (app()->bound('sentry') && $this->shouldReport($exception)) {
			app('sentry')->captureException($exception);
		}

		parent::report($exception);
	}
}
