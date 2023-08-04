<?php

namespace PixiiBomb\Essentials;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class PixiiBombEssentialsServiceProvider extends ServiceProvider
{
    private function fromPackage($path, $isFile = true): string
    {
        $extension = $isFile ? '.php' : null;
        return __DIR__.'/../'.$path.$extension;
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->publishes([
            $this->fromPackage('config/setup') => config_path(PIXII.'.php'), //__DIR__.'/../config/setup.php'
        ], 'config');
        $this->publishes([
            $this->fromPackage('public', false) => public_path(),
        ], 'public');
        $this->publishes([
            $this->fromPackage('resources/views', false) => resource_path(),
        ], 'views');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Route::prefix('')
            ->group(function() {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
                $this->loadRoutesFrom(__DIR__ . '/../routes/user.php');
            });

        $this->loadViewsFrom(__DIR__ . '/../resources/views/', PIXII);
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang/', PIXII);
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/');

        $this->mergeConfigFrom(__DIR__.'/../config/setup.php', PIXII);

        $this->registerComponents();
    }

    /**
     * Register the components.
     */
    protected function registerComponents(): void
    {
        $components = [
            ACCORDION => \PixiiBomb\Essentials\View\Components\Accordion::class,
            BREADCRUMBS => \PixiiBomb\Essentials\View\Components\Breadcrumbs::class,
            CONTAINER => \PixiiBomb\Essentials\View\Components\Container::class,
            FORM => \PixiiBomb\Essentials\View\Components\Form::class,
            NAVIGATION => \PixiiBomb\Essentials\View\Components\Navigation::class,
        ];

        foreach ($components as $alias => $class) {
            Blade::component($alias, $class, PIXII);
        }
    }
}
