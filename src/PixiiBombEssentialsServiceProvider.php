<?php

namespace PixiiBomb\Essentials;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class PixiiBombEssentialsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Blade::componentNamespace('PixiiBomb\\Essentials\\View\\Components', PIXII);

        Blade::if(DEBUG, function() {
            return env('APP_DEBUG');
        });

        $this->publishes([
            $this->fromPackage('publish/public') => public_path(),
        ], 'public');
        $this->publishes([
            $this->fromPackage('publish/resources') => resource_path(),
        ], 'resources');
        $this->publishes([
            $this->fromPackage('publish/config') => config_path(),
        ], 'config');
    }

    private function fromPackage($path): string
    {
        return __DIR__.'/../'.$path;
    }
}
