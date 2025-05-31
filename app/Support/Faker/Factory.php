<?php

namespace App\Support\Faker;

use App\Support\Faker\Providers\LoremPicsum;
use Faker\Generator;

class Factory extends \Faker\Factory
{
	/** @noinspection MissingParentCallInspection */
	#[\Override]
	public static function create($locale = \Faker\Factory::DEFAULT_LOCALE): Generator
	{
		$generator = new Generator();

		foreach (static::$defaultProviders as $provider) {
			if ($provider === 'Image') {
				$generator->addProvider(new LoremPicsum($generator));
				continue;
			}

			$providerClassName = self::getProviderClassname($provider, $locale);
			$generator->addProvider(new $providerClassName($generator));
		}

		return $generator;
	}
}
