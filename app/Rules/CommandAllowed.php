<?php

namespace App\Rules;

use App\Actions\LogCommandEvent;
use App\Models\Command;

class CommandAllowed extends Allowed
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure $fail
     * @return void
	 *
	 * TODO: migrate PHPDoc to signature when interface allows
     */
	public function __invoke(string $attribute, mixed $value, \Closure $fail): void
	{
		if ($this->found($value)) return;

		LogCommandEvent::make()(
			command: Command::whereSignature($value)->firstOrFail(),
			succeeded: false,
			message: 'User is not allowed to run this command.',
		);

		if ($attribute === 'command') {
			$fail(sprintf(trans('commands.run_failed'), $value));
			return;
		}

		$fail(':attribute is not allowed.');
	}
}
