<?php

namespace App\Console\Commands;

use App\Mail\WeeklyReportEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendWeeklyReportCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'reports:weekly';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send the weekly admin report for this project.';

	/**
	 * Execute the console command.
	 */
	public function handle() {
		$this->info('Sending weekly admin report...');

		Mail::send(new WeeklyReportEmail());

		$this->info('Mail sent!');
	}
}
