<?php

namespace PixiiBomb\Essentials;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use PixiiBomb\Essentials\Requests\RegisterUserRequest;


class PixiiBombEssentialsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->publishes([
            __DIR__.'/../config/setup.php' => config_path(PIXII.'.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../public' => public_path(),
        ], 'public');
        /*$this->app->bind(RegisterUserRequest::class, function ($app) {
            return new RegisterUserRequest();
        }) */
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
            });

        $this->loadViewsFrom(__DIR__ . '/../resources/views/', PIXII);
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang/', PIXII);
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/');

        /*$this->publishes([
            __DIR__ . '/../resources/lang/' => resource_path('lang/vendor/pixii'),
        ], 'translations');*/

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
