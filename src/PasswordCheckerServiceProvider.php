<?php

namespace Effectix\PasswordChecker;

use Illuminate\Support\ServiceProvider;

class PasswordCheckerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'effectix/password-checker');

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
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/passwordchecker.php', 'passwordchecker');
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
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/passwordchecker.php' => config_path('passwordchecker.php'),
        ], 'passwordchecker.config');

        // Publishing the rule file.
        $this->publishes([
            __DIR__.'/Rules/PasswordScoreRule.php' => app_path('Rules/PasswordScoreRule.php'),
        ], 'passwordchecker.rules');

        $this->publishes([
            __DIR__.'/../lang' => resource_path('lang/vendor/effectix/password-checker'),
        ], 'passwordchecker.locales');
    }
}
