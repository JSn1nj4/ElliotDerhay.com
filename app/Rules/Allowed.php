<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class Allowed implements InvokableRule
{
	public function __construct(
		protected array $whitelist,
	)
	{
		//
	}

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param  mixed  $value
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     * @return void
	 *
	 * TODO: migrate PHPDoc to signature when interface allows
     */
    public function __invoke(string $attribute, mixed $value, \Closure $fail): void
	{
        if ($this->found($value)) return;

		$fail(':attribute is not allowed.');
    }

	protected function found($value): bool
	{
		return in_array($value, $this->whitelist, true);
	}
}
