<?php

namespace Styphon\LaravelLocalisation;

use Illuminate\Support\Facades\Facade;

class LocalisationFacade extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'localisation';
	}
}