<?php

namespace Projects\Widget;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class WidgetServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        
        Blade::directive('widget', function($expression){

            return "<?= resolve({$expression}); ?>";
        });
        
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'projects');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'projects');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/widget.php', 'widget');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['widget'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/widget.php' => config_path('widget.php'),
        ], 'widget.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/projects'),
        ], 'widget.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/projects'),
        ], 'widget.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/projects'),
        ], 'widget.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
