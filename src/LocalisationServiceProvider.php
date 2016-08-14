<?php

namespace Styphon\LaravelLocalisation;

use Illuminate\Support\ServiceProvider;
use Localisation;

class LocalisationServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 */
    public function boot()
    {
	    Localisation::setLocaleAndUrl();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
	    $configPath = __DIR__ . '/../config/localisation.php';
	    $this->mergeConfigFrom($configPath, 'localisation');
        $this->app->bind('localisation', 'Styphon\LaravelLocalisation\Localisation');
    }
}
