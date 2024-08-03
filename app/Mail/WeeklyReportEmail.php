<?php

namespace App\Mail;

use App\Models\LoginActivity;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WeeklyReportEmail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Get the message envelope.
	 */
	public function envelope(): Envelope
	{
		return new Envelope(
			subject: 'Weekly Admin Report',
		);
	}

	/**
	 * Get the message content definition.
	 */
	public function content(): Content
	{
		return new Content(
			markdown: 'emails.reports.weekly',
			with: [
				'lastLogin' => LoginActivity::succeeded()
						->latest()
						->first()
						?->created_at
						->toDayDateTimeString() ?? 'No recent logins.',

				'lastFailure' => LoginActivity::failed()
						->latest()
						->first()
						?->created_at
						->toDayDateTimeString() ?? 'No recent login failures.',

				'postsPublished' => Post::publishedRecently()->count(),
			],
		);
	}

	/**
	 * Get the attachments for the message.
	 *
	 * @return array<int, \Illuminate\Mail\Mailables\Attachment>
	 */
	public function attachments(): array
	{
		return [];
	}
}
