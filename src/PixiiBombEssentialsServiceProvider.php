<?php

namespace PixiiBomb\Essentials;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class PixiiBombEssentialsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        /*$this->publishes([
            $this->fromPackage('publish/public', false) => public_path(),
        ], 'public');
        $this->publishes([
            $this->fromPackage('publish/resources', false) => resource_path(),
        ], 'resources'); */
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }

    private function fromPackage($path, $isFile = true): string
    {
        $extension = $isFile ? '.php' : null;
        return __DIR__.'/../'.$path.$extension;
    }
}
