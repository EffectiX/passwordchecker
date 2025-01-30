<?php

namespace Effectix\PasswordChecker;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class PasswordCheckerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        Livewire::component('password-strength-bar', \Effectix\PasswordChecker\Http\Livewire\PasswordStrengthBar::class);

        // Register view namespace
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'effectix/password-checker/password-strength-bar');
        // Register locale namespace
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'effectix/password-checker');

        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'effectix');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/passwordchecker.php' => config_path('passwordchecker.php'),
        ], 'passwordchecker.config');

        // Publishing the rule file.
        $this->publishes([
            __DIR__.'/../stubs/PasswordScoreRule.php.stub' => app_path('Rules/PasswordScoreRule.php'),
        ], 'passwordchecker.rules');
        // Publishing the locale files
        $this->publishes([
            __DIR__.'/../lang' => resource_path('lang/vendor/effectix/password-checker'),
        ], 'passwordchecker.locales');
        // Publishing the livewire views
        $this->publishes([
            __DIR__.'/../resources/views/livewire' => resource_path('views/vendor/password-strength-bar/livewire'),
        ], 'passwordchecker.livewire');

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
}
