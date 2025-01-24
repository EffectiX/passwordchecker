<?php

namespace EffectiX\PasswordChecker;

use EffectiX\PasswordChecker\Facades\CommonPattern;
use EffectiX\PasswordChecker\Facades\Entropy;
use EffectiX\PasswordChecker\Facades\Length;
use EffectiX\PasswordChecker\Facades\PasswordChecker;
use EffectiX\PasswordChecker\Facades\Variety;
use Illuminate\Support\ServiceProvider;

class PasswordCheckerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'effectix');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'effectix');
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
        $this->mergeConfigFrom(__DIR__.'/../config/passwordchecker.php', 'passwordchecker');

        $this->app->singleton('Entropy', Entropy::class);
        $this->app->singleton('Length', Length::class);
        $this->app->singleton('CommonPattern', CommonPattern::class);
        $this->app->singleton('Variety', Variety::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['passwordchecker'];
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
            __DIR__.'/../config/passwordchecker.php' => config_path('passwordchecker.php'),
        ], 'passwordchecker.config');

        // Publishing the rule file.
        $this->publishes([
            __DIR__.'/Rules/PasswordScoreRule.php' => app_path('Rules/PasswordScoreRule.php')
        ], 'passwordchecker.rules');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/effectix'),
        ], 'passwordchecker.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/effectix'),
        ], 'passwordchecker.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/effectix'),
        ], 'passwordchecker.lang');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
