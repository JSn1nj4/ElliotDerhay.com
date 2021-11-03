<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GithubEventEmail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Store email "from" name
	 *
	 * @property                $fromName
	 * @access private
	 */
	private $fromName       = 'ElliotDerhay.com';

	/**
	 * Store email "from" address
	 *
	 * @property                $fromAddress
	 * @access private
	 */
	private $fromAddress    = 'web@elliotderhay.com';

	/**
	 * Store email subject line
	 *
	 * @property                $subject
	 * @access public
	 */
	public $subject        = 'New GitHub Event Type';

	/**
	 * Store GitHub event types to send email about
	 *
	 * @property                $types
	 * @access public
	 */
	public $types;

	/**
	 * Create a new message instance
	 *
	 * @method                  __construct
	 * @access public
	 *
	 * @param array             $eventTypes
	 *
	 * @return void
	 */
	public function __construct(array $eventTypes)
	{
		if( !(count($eventTypes) >= 1) ) {
			return abort(500);
		}

		$this->types = $eventTypes;
	}

	/**
	 * Build the email message
	 *
	 * @method                  build
	 * @access public
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->view('emails.github.new-event-type')
					->from($this->fromAddress, $this->fromName)
					->replyTo($this->fromAddress, $this->fromName)
					->subject($this->subject);
	}
}
