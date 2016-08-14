<?php

namespace Styphon\LaravelLocalisation;

use App;
use Request;
use Symfony\Component\HttpFoundation\ServerBag;
use URL;

class Localisation
{
	/**
	 * Look for a localisation specified in the URL. If found, set the locale and strip it from the URL, allowing all
	 * routes to work without worrying about having an optional locale in the URL.
	 */
	public function setLocaleAndUrl()
	{
		/* @var $server ServerBag */
		$server = Request::instance()->server;
		$langs = implode('|', config('localisation.validLocales'));
		$regex = '/(\/(?:' . $langs . ')(?=\/)|((?<=\/)(?:' . $langs . ')(?!.)))/';
		preg_match($regex, $server->get('PATH_INFO'), $matches);
		if ( count($matches) )
		{
			App::setLocale(trim($matches[0], '/'));
			$server->set('REQUEST_URI', preg_replace('/(' . preg_quote($matches[0], '/') . ')(?=\/|\?|(?!.))/', '', Request::instance()->server->get('REQUEST_URI')));
			$server->set('PATH_INFO', preg_replace('/(' . preg_quote($matches[0], '/') . ')(?=\/|\?|(?!.))/', '', Request::instance()->server->get('PATH_INFO')));
			$server->set('PHP_SELF', preg_replace('/(' . preg_quote($matches[0], '/') . ')(?=\/|\?|(?!.))/', '', Request::instance()->server->get('PHP_SELF')));
		}

		if ( App::getLocale() != config('localisation.defaultLocale') )
		{
			Url::forceRootUrl(url('/') . '/' . App::getLocale());
		}
	}


}