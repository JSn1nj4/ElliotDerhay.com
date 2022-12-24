<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordChangedEmail extends Mailable
{
    use Queueable, SerializesModels;

	private string $fromName = 'ElliotDerhay.com';

	private string $fromAddress = 'security@elliotderhay.com';

	public $subject = 'Password Changed';

    public function __construct()
    {
        //
    }

    public function build(): self
    {
        return $this->view('emails.password-changed')
			->from($this->fromAddress, $this->fromName)
			->replyTo($this->fromAddress, $this->fromName)
			->subject($this->subject);
    }
}
